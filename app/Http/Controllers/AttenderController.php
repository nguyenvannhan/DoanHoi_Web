<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\School_Year;
use App\Models\Activity;
use App\Models\Student;
use App\Models\Faculty;
use App\Models\Science;
use App\Models\Classes;
use App\Models\Attender;

class AttenderController extends Controller {
    public function index() {
        $this->data['schoolYearList'] = School_Year::orderBy('name', 'desc')->take(10)->get();

        return view('attender.index', $this->data);
    }

    public function getAttenderList($activity_id) {
        $this->data['attenderList'] = Attender::with('Student', 'Activity')->where('activity_id', $activity_id)->orderBy('updated_at', 'desc')->get();

        return response()->view('attender.load-attender-table', $this->data);
    }

    public function postCheckAttend(Request $request) {
        $attender = Attender::find($request->id);
        if(!is_null($attender)) {
            if($attender->check) {
                $attender->check = 0;
                $this->data['check'] = false;
            } else {
                $attender->check = 1;
                $this->data['check'] = true;
            }
            $attender->save();
            $this->data['result'] = true;
        } else {
            $this->data['result'] = false;
        }
        // $attender->save();
        return response()->json($this->data);
    }

    public function getActivityListBySchoolYear($schoolyear_id) {
        $activityList = Activity::with('Leader', 'ClassOb', 'SchoolYear')->where('school_year_id', $schoolyear_id)->orderBy('start_date', 'desc')->get();

        $htmlContent = '';

        foreach($activityList as $activity) {
            $htmlContent .= '<option value="'.$activity->id.'">'.date('d/m/Y', strtotime($activity->start_date)).' - '.$activity->name.'</option>';
        }

        $this->data['htmlContent'] = $htmlContent;
        return response()->json($this->data);
    }

    public function getStudentInfo($id) {
        $student = Student::find($id);
        $facultyList = Faculty::orderBy('id', 'asc')->get();
        $scienceList = Science::orderBy('name', 'desc')->take(10)->get();
        $classList = [];
        if(!is_null($student) && $student->is_it_student) {
            $classList = Classes::where('science_id', $student->science_id)->orderBy('name', 'desc')->get();
        }

        $this->data['student'] = $student;
        $this->data['facultyList'] = $facultyList;
        $this->data['scienceList'] = $scienceList;
        $this->data['classList'] = $classList;

        return response()->json($this->data);
    }

    public function postAddAttender(Request $request) {
        $attender = $request;
        $student = Student::find($attender->id);
        $check_number = Attender::where('activity_id', $attender->activity_id)->count();
        $activity = Activity::find($attender->activity_id);

        \DB::beginTransaction();

        try {
            if($check_number < $activity->max_regis_number) {
                if(!is_null($student)) {
                    if($student->email != $attender->email) {
                        $student->email = $attender->email;
                    }
                    if($student->number_phone != $attender->numberphone) {
                        $student->number_phone = $attender->numberphone;
                    }
                    $student->save();


                } else {
                    $attender->validate([
                        'name' => 'required',
                        'science_id' => 'required',
                        'faculty_id' => 'required',
                        'class_id' => 'required_if:faculty_id,1'
                    ], [
                        'name.required' => 'Tên sinh viên',
                        'science_id.required' => 'Chọn khóa học',
                        'faculty_id.required' => 'Chọn Khoa',
                        'class_id.required_if' => 'Chọn lớp học.'
                    ]);

                    $student = new Student;
                    $student->id = $attender->id;
                    $student->name = $attender->name;
                    $student->email = $attender->email;
                    $student->number_phone = $attender->numberphone;
                    $student->science_id = $attender->science_id;
                    $student->faculty_id = $attender->faculty_id;
                    if($attender->faculty_id == 1) {
                        $student->class_id = $attender->class_id;
                        $student->is_it_student = 1;
                    } else {
                        $student->is_it_student = 0;
                    }
                    $student->save();
                }

                $newAttender = Attender::where('student_id', $attender->id)->where('activity_id', $attender->activity_id)->first();

                if(!is_null($newAttender)) {
                    $errors[0] = 'Người đăng ký đã tồn tại!';
                    $this->data['errors'] = $errors;
                    return response()->json($this->data);
                }

                $newAttender = new Attender;
                $newAttender->activity_id = $attender->activity_id;
                $newAttender->student_id = $attender->id;
                $newAttender->save();

                $activity->max_regis_number += 1;
                $activity->save();
            } else {
                $errors[0] = 'Hoạt động đã đủ người!!!';
                $this->data['errors'] = $errors;
                return response()->json($this->data);
            }

            \DB::commit();
            $this->data['attenderList'] = Attender::with('Student', 'Activity')->where('activity_id', $attender->activity_id)->orderBy('updated_at', 'desc')->get();
            return response()->view('attender.load-attender-table', $this->data);
        } catch(\Exception $e){
            \DB::rollBack();
            return false;
        }
    }

    public function postUpdateConduct(Request $request) {
        $attender = Attender::find($request->id);

        if(!is_null($attender)) {
            if($request->conduct_mark < 0) {
                $attender->conduct_mark = 0;
                $attender->minus_conduct_mark = (-1)*$request->conduct_mark;
            } else {
                $attender->minus_conduct_mark = 0;
                $attender->conduct_mark = $request->conduct_mark;
            }

            $attender->save();

            return true;
        }
        return false;
    }

    public function postUpdateSocial(Request $request) {
        $attender = Attender::find($request->id);

        if(!is_null($attender)) {
            if($request->social_mark < 0) {
                $attender->social_mark = 0;
                $attender->minus_social_mark = (-1)*$request->social_mark;
            } else {
                $attender->minus_social_mark = 0;
                $attender->social_mark = $request->social_mark;
            }

            $attender->save();

            return true;
        }
        return false;
    }
}
