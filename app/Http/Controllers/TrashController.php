<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Attender;
use App\Models\Check_Number;
use App\Models\Classes;
use App\Models\Student;
use App\Models\User;
use App\Models\Log;
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
        $nameLog = '';
        $old_data = '';
        $new_data = '';

        $this->data['type_id'] = $request->type_id;
        if ($request->type_id == 1) {
            $student = Student::onlyTrashed()->find($request->id);
            $student->restore();

            $nameLog = 'Restore Sinh viên';
            $new_data = "id: <b>$student->id</b><br/>"
                        ."Tên: <b>$student->name</b><br/>"
                        ."Lớp: <b>".$student->ClassOb->name."</b><br/>"
                        ."Khóa: <b>".$student->Science->name."</b>";
            Log::addToLog($nameLog, $old_data, $new_data);

            $this->data['studentList'] = Student::onlyTrashed()->with(['ClassOb', 'Science'])->get();
        } elseif ($request->type_id == 2) {
            $activity = Activity::onlyTrashed()->find($request->id);
            $activity->restore();

            if($activity->level == 0) {
                $level = "Chi đoàn";
                $classSentence = "<br/>Lớp: <b>".$activity->ClassOb->name."</b>";
            } elseif($activity->level == 1) {
                $level = "Cấp Khoa";
                $classSentence = "";
            } else {
                $level = "Cấp trường";
                $classSentence = "";
            }

            $nameLog = 'Restore Hoạt động';
            $new_data = "id: <b>$activity->id</b><br/>"
                        ."Tên: <b>$activity->name</b><br/>"
                        ."Năm học: <b>".$student->SchoolYear->name."</b><br/>"
                        ."Cấp độ: <b>".$level."</b>"
                        .$classSentence;

            Log::addToLog($nameLog, $old_data, $new_data);

            $this->data['activityLitst'] = Activity::onlyTrashed()->with(['Leader', 'ClassOb', 'SchoolYear', 'Attenders'])->get();
        } else {

            $classOb = Classes::onlyTrashed()->find($request->id);
            $classOb->restore();

            $nameLog = 'Restore Lớp học';
            $new_data = "Id: <b>".$classOb->id."</b><br/>"
                        ."Tên: <b>".$classOb->name."</b><br/>"
                        ."Khóa: <b>".$classOb->Science->name."</b>";
            Log::addToLog($nameLog, $old_data, $new_data);

            $this->data['classList'] = Classes::onlyTrashed()->with(['Students', 'Science'])->get();
        }

        return response()->view('trash.data-table', $this->data);
    }

    public function ajaxPermantly(Request $request)
    {
        // Data for log
        $nameLog = '';
        $old_data = '';
        $new_data = '';


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

            $nameLog = 'Xóa vĩnh viễn Sinh viên';
            $old_data = "id: <b>$temp_data->id</b><br/>"
                        ."Tên: <b>$temp_data->name</b><br/>"
                        ."Lớp: <b>".$temp_data->ClassOb->name."</b><br/>"
                        ."Khóa: <b>".$temp_data->Science->name."</b>";
            Log::addToLog($nameLog, $old_data, $new_data);

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

            if($temp_data->level == 0) {
                $level = "Chi đoàn";
                $classSentence = "<br/>Lớp: <b>".$activity->ClassOb->name."</b>";
            } elseif($temp_data->level == 1) {
                $level = "Cấp Khoa";
                $classSentence = "";
            } else {
                $level = "Cấp trường";
                $classSentence = "";
            }

            $nameLog = 'Xóa vĩnh viễn Hoạt động';
            $old_data = "id: <b>$temp_data->id</b><br/>"
                        ."Tên: <b>$temp_data->name</b><br/>"
                        ."Năm học: <b>".$temp_data->SchoolYear->name."</b><br/>"
                        ."Cấp độ: <b>".$level."</b>"
                        .$classSentence;

            Log::addToLog($nameLog, $old_data, $new_data);

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

            $nameLog = 'Xóa vĩnh viễn Lớp học';
            $old_data = "Id: <b>".$temp_data->id."</b><br/>"
                        ."Tên: <b>".$temp_data->name."</b><br/>"
                        ."Khóa: <b>".$temp_data->Science->name."</b>";
            Log::addToLog($nameLog, $old_data, $new_data);

            $this->data['classList'] = Classes::onlyTrashed()->with(['Students', 'Science'])->get();
        }

        return response()->view('trash.data-table', $this->data);
    }
}
