<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Attender;
use App\Models\Check_Number;
use App\Models\Classes;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class TrashController extends Controller
{
    public function index()
    {
        return view('trash.index');
    }

    public function ajaxGetData($type_id)
    {
        $this->data['type_id'] = $type_id;
        if ($type_id == 1) {
            $this->data['studentList'] = Student::onlyTrashed()->has('ClassOb')->with(['ClassOb', 'Science'])->get();
        } elseif ($type_id == 2) {
            $this->data['activityLitst'] = Activity::onlyTrashed()->with(['Leader', 'ClassOb', 'SchoolYear', 'Attenders'])->get();
        } else {
            $this->data['classList'] = Classes::onlyTrashed()->with(['Students', 'Science'])->get();
        }

        return response()->view('trash.data-table', $this->data);
    }

    public function ajaxRestore(Request $request)
    {
        $this->data['type_id'] = $request->type_id;
        if ($request->type_id == 1) {
            $student = Student::onlyTrashed()->find($request->id);
            $student->restore();

            $this->data['studentList'] = Student::onlyTrashed()->with(['ClassOb', 'Science'])->get();
        } elseif ($request->type_id == 2) {
            $activity = Activity::onlyTrashed()->find($request->id);
            $activity->restore();

            $this->data['activityLitst'] = Activity::onlyTrashed()->with(['Leader', 'ClassOb', 'SchoolYear', 'Attenders'])->get();
        } else {
            $classOb = Classes::onlyTrashed()->find($request->id);
            $classOb->restore();

            $this->data['classList'] = Classes::onlyTrashed()->with(['Students', 'Science'])->get();
        }

        return response()->view('trash.data-table', $this->data);
    }

    public function ajaxPermantly(Request $request)
    {
        $id = $request->id;
        $type_id = $request->type_id;

        $this->data['type_id'] = $type_id;

        if ($type_id == 1) {
            $temp_data = User::where('student_id', $id)->get();

            foreach ($temp_data as $data) {
                $data->delete();
            }

            $temp_data = Check_Number::where('student_id', $id)->get();
            foreach ($temp_data as $data) {
                $data->delete();
            }

            $temp_data = Attender::where('student_id', $id)->get();
            foreach ($temp_data as $data) {
                $data->delete();
            }

            $temp_data = Activity::withTrashed()->where('leader', $id)->get();
            foreach ($temp_data as $data) {
                $data->forceDelete();
            }

            $temp_data = Student::onlyTrashed()->find($id);
            $temp_data->forceDelete();

            $this->data['studentList'] = Student::onlyTrashed()->with(['ClassOb', 'Science'])->get();

        } elseif ($type_id == 2) {
            $temp_data = Attender::where('activity_id', $id)->get();
            foreach ($temp_data as $data) {
                $data->delete();
            }

            $temp_data = Check_Number::where('activity_id', $id)->get();
            foreach ($temp_data as $data) {
                $data->delete();
            }

            $temp_data = Activity::onlyTrashed()->find($id);
            $temp_data->forceDelete();

            $this->data['activityLitst'] = Activity::onlyTrashed()->with(['Leader', 'ClassOb', 'SchoolYear', 'Attenders'])->get();
        } else {
            $temp_data = Student::withTrashed()->where('class_id', $id)->get();
            foreach ($temp_data as $data) {
                $temp_data1 = User::where('student_id', $data->id)->get();

                foreach ($temp_data1 as $data1) {
                    $data1->delete();
                }

                $temp_data1 = Check_Number::where('student_id', $data->id)->get();
                foreach ($temp_data1 as $data1) {
                    $data1->delete();
                }

                $temp_data1 = Attender::where('student_id', $data->id)->get();
                foreach ($temp_data1 as $data1) {
                    $data1->delete();
                }

                $temp_data1 = Activity::withTrashed()->where('leader', $data->id)->get();
                foreach ($temp_data1 as $data1) {
                    $data1->forceDelete();
                }

                $data->forceDelete();
            }

            $temp_data = Activity::withTrashed()->where('class_id', $id)->get();
            foreach ($temp_data as $data) {
                $temp_data1 = Attender::where('activity_id', $data->id)->get();
                foreach ($temp_data1 as $data1) {
                    $data1->delete();
                }

                $temp_data1 = Check_Number::where('activity_id', $data->id)->get();
                foreach ($temp_data1 as $data1) {
                    $data1->delete();
                }

                $data->forceDelete();
            }

            $temp_data = Classes::onlyTrashed()->find($id);
            $temp_data->forceDelete();

            $this->data['classList'] = Classes::onlyTrashed()->with(['Students', 'Science'])->get();
        }

        return response()->view('trash.data-table', $this->data);
    }
}
