<?php

namespace App\Http\Controllers;

use Validator;

use App\Http\Requests\AddAttenderRequest;
use Illuminate\Http\Request;
use App\Models\School_Year;
use App\Models\Activity;
use App\Models\Student;
use App\Models\Faculty;
use App\Models\Science;
use App\Models\Classes;
use App\Models\Attender;
use DB;
use Exception;
use Excel;

class AttenderController extends Controller {
    public function index() {
        $this->data['schoolYearList'] = School_Year::orderBy('name', 'desc')->take(10)->get();

        $attenderList = session('attenderList', '');
        $schoolyear_id = session('schoolyear_id', '');
        $activity_id = session('activity_id', '');
        $schoolYearList = session('schoolYearList', '');
        $activityList = session('activityList', '');

        if($attenderList != '') {
            $this->data['attenderList'] = $attenderList;
            $this->data['schoolyear_id'] = $schoolyear_id;
            $this->data['activity_id'] = $activity_id;
            $this->data['schoolYearList'] = $schoolYearList;
            $this->data['activityList'] = $activityList;
        }
        return view('attender.index', $this->data);
    }

    public function getAttenderList($activity_id) {
        $this->data['attenderList'] = Attender::with('Student', 'Activity')->where('activity_id', $activity_id)->orderBy('updated_at', 'desc')->get();

        return response()->view('attender.load-attender-table', $this->data);
    }

    public function postCheckAttend(Request $request) {
        $attender = Attender::find($request->id);

        $conduct_mark = 0;
        $social_mark = 0;

        if(!is_null($attender)) {
            if($attender->check) {
                $attender->check = 0;

                if($attender->Activity->social_mark > 0) {
                    if($attender->social_mark == 0) {

                        $attender->minus_social_mark = $attender->Activity->social_mark;
                    } else {
                        $attender->minus_social_mark = $attender->social_mark;
                    }
                } else {
                    $attender->minus_social_mark = 0;
                }

                $social_mark = -1 * $attender->minus_social_mark;

                if($attender->Activity->conduct_mark > 0) {
                    if($attender->conduct_mark == 0) {
                        $attender->minus_conduct_mark = $attender->Activity->conduct_mark;
                    } else {
                        $attender->minus_conduct_mark = $attender->conduct_mark;
                    }
                } else {
                    $attender->minus_conduct_mark = 0;
                }

                $conduct_mark = -1 * $attender->minus_conduct_mark;

                $attender->social_mark = 0;
                $attender->conduct_mark = 0;

                $this->data['check'] = false;
            } else {
                $attender->check = 1;

                if($attender->Activity->social_mark > 0) {
                    if($attender->minus_social_mark == 0) {

                        $attender->social_mark = $attender->Activity->social_mark;
                    } else {
                        $attender->social_mark = $attender->minus_social_mark;
                    }
                } else {
                    $attender->social_mark = 0;
                }
                $social_mark = $attender->social_mark;

                if($attender->Activity->conduct_mark > 0) {
                    if($attender->minus_conduct_mark == 0) {
                        $attender->conduct_mark = $attender->Activity->conduct_mark;
                    } else {
                        $attender->conduct_mark = $attender->minus_conduct_mark;
                    }
                } else {
                    $attender->conduct_mark = 0;
                }
                $conduct_mark = $attender->conduct_mark;

                $attender->minus_social_mark = 0;
                $attender->minus_conduct_mark = 0;

                $this->data['check'] = true;
            }
            $attender->save();
            $this->data['result'] = true;
        } else {
            $this->data['result'] = false;
        }
        $this->data['conduct_mark'] = $conduct_mark;
        $this->data['social_mark'] = $social_mark;

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

    public function postAddAttender(AddAttenderRequest $request) {
        $attender = $request;
        $student = Student::find($attender->id);
        $check_number = Attender::where('activity_id', $attender->activity_id)->count();
        $activity = Activity::find($attender->activity_id);

        DB::beginTransaction();

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

            DB::commit();
            $this->data['attenderList'] = Attender::with('Student', 'Activity')->where('activity_id', $attender->activity_id)->orderBy('updated_at', 'desc')->get();
            return response()->view('attender.load-attender-table', $this->data);
        } catch(Exception $e){
            DB::rollBack();
            return false;
        }
    }

    public function postUpdateMark(Request $request) {
        $attender = Attender::find($request->id);

        if(!is_null($attender)) {
            if($request->conduct_mark <= $attender->Activity->conduct_mark) {
                if($request->conduct_mark < 0) {
                    $attender->conduct_mark = 0;
                    $attender->minus_conduct_mark = (-1)*$request->conduct_mark;
                } else {
                    $attender->minus_conduct_mark = 0;
                    $attender->conduct_mark = $request->conduct_mark;
                }

                if($request->social_mark <= $attender->Activity->social_mark) {
                    if($request->social_mark < 0) {
                        $attender->social_mark = 0;
                        $attender->minus_social_mark = (-1)*$request->social_mark;
                    } else {
                        $attender->minus_social_mark = 0;
                        $attender->social_mark = $request->social_mark;
                    }

                    if($request->conduct_mark < 0 || $request->social_mark < 0) {
                        $attender->check = 0;
                    } else {
                        $attender->check = 1;
                    }

                    $attender->save();
                    $this->data['check'] = $attender->check;
                    $this->data['result'] = true;
                } else {
                    $this->data['result'] = false;
                    $this->data['error'] = 'Điểm Rèn luyện quá mức!!!';
                }
            } else {
                $this->data['result'] = false;
                $this->data['error'] = 'Điểm Rèn luyện quá mức!!!';
            }
        } else {
            $this->data['result'] = false;
            $this->data['error'] = 'Điểm Rèn luyện quá mức!!!';
        }
        return response()->json($this->data);
    }

    public function postDeleteAttender(Request $request) {
        $attender = Attender::find($request->id);

        if(!is_null($attender)) {
            $attender->forceDelete();
            $this->data['result'] = true;
        } else {
            $this->data['error'] = 'Không tồn tại Người tham gia!';
            $this->data['result'] = false;
        }

        return response()->json($this->data);
    }

    public function getImportAttenderList() {
        $schoolYearList = School_Year::orderBy('name', 'desc')->take(10)->get();

        $this->data['schoolYearList'] = $schoolYearList;
        return view('attender.import_attenders_list', $this->data);
    }

    public function postImportAttenderList(Request $request) {
        if($request->hasFile('import')) {
            $schoolyear_id = $request->schoolyear_id;
            $activity_id = $request->activity_id;
            $result = Excel::load($request->import, function($reader){
            })->get()->toArray();

            $attenderList = [];
            $errors = [];
            $names = [];

            foreach($result as $attender_file) {
                $attender_file = array_values($attender_file);
                $attender = new Attender;
                $attender->student_id = $attender_file[0];
                if($attender_file[1] != NULL) {
                    $attender->check = 1;
                } else {
                    $attender->check = 0;
                }

                array_push($attenderList, $attender);

                $student = Student::find($attender_file[0]);
                if(!is_null($student)) {
                    array_push($names, $student->name);
                } else {
                    array_push($errors, 'SV '.$attender_file[0].' không tồn tại.');
                    array_push($names, '');
                }

                $old_attender = Attender::where('student_id', $attender_file[0])->where('activity_id', $activity_id)->first();
                if(!is_null($old_attender)) {
                    array_push($errors, 'SV '.$attender_file[0].' đã đăng ký rồi.');
                }
            }

            $schoolYearList = School_Year::orderBy('name', 'desc')->take(10)->get();
            $activityList = Activity::where('school_year_id', $schoolyear_id)->orderBy('start_date', 'desc')->get();
            $this->data['attenderList'] = $attenderList;
            $this->data['names'] = $names;
            $this->data['errors'] = $errors;
            $this->data['schoolyear_id'] = $schoolyear_id;
            $this->data['activity_id'] = $activity_id;
            $this->data['schoolYearList'] = $schoolYearList;
            $this->data['activityList'] = $activityList;

            return view('attender.import_attenders_list', $this->data);
        } else {
            return redirect()->route('get_import_attender_list_route');
        }
    }

    public function postSubmitImportAttenderList(Request $request) {
        DB::beginTransaction();
        try {
            $student_id_arr = array_values($request->student_id);
            $check_arr = array_values($request->check);

            for($i = 0; $i < count($student_id_arr); $i++) {
                $attender = new Attender;
                $attender->student_id = $student_id_arr[$i];
                $attender->check = $check_arr[$i];
                $attender->activity_id = $request->activity_id;

                $attender->save();
            }
            DB::commit();

            $schoolYearList = School_Year::orderBy('name', 'desc')->take(10)->get();
            $activity = Activity::find($request->activity_id);
            $activityList = Activity::where('school_year_id', $activity->SchoolYear->id)->orderBy('start_date', 'desc')->get();
            $attenderList = Attender::where('activity_id', $request->activity_id)->get();
            $activity_id = $request->activity_id;
            $school_year_id = $activity->SchoolYear->id;


            $this->data['attenderList'] = $attenderList;
            $this->data['schoolyear_id'] = $school_year_id;
            $this->data['activity_id'] = $activity_id;
            $this->data['schoolYearList'] = $schoolYearList;
            $this->data['activityList'] = $activityList;

            session($this->data);

            return redirect()->route('get_attender_index_route');
        } catch(Exception $e) {
            DB::rollBack();
            $this->data['error'] = $e->getMessage();
            return $this->data;
        }
    }

    public function getImportMarkList() {
        $schoolYearList = School_Year::orderBy('name', 'desc')->take(10)->get();

        $this->data['schoolYearList'] = $schoolYearList;
        return view('attender.import-mark', $this->data);
    }

    public function postImportMarkList(Request $request) {
        if($request->hasFile('import')) {
            $schoolyear_id = $request->schoolyear_id;
            $activity_id = $request->activity_id;
            $result = Excel::load($request->import, function($reader) {
            })->get()->toArray();
            if($request->type_id == 1) {
                $max_mark = Activity::find($activity_id)->conduct_mark;
            } else {
                $max_mark = Activity::find($activity_id)->social_mark;
            }

            $attenderList = [];
            $errors = [];
            $names = [];

            foreach($result as $attender_file) {
                $attender_file = array_values($attender_file);
                $attender = new Attender;
                $attender->student_id = $attender_file[0];
                if($attender_file[1] != NULL) {
                    $attender->mark = $attender_file[1];

                    if($attender->mark > $max_mark) {
                        array_push($errors, 'Điểm của SV '.$attender->student_id.' cao hơn quy định.');
                    }

                    if(! filter_var($attender_file[1], FILTER_VALIDATE_INT)) {
                        array_push($errors, 'Điểm của SV '.$attender->student_id.' không đúng.');
                    }
                } else {
                    $attender->mark = 0;
                }

                array_push($attenderList, $attender);

                $student = Student::find($attender_file[0]);
                if(!is_null($student)) {
                    $attender->name = $student->name;
                } else {
                    array_push($errors, 'SV '.$attender_file[0].' không tồn tại.');
                }

                $old_attender = Attender::where('student_id', $attender_file[0])->where('activity_id', $activity_id)->first();
                if(is_null($old_attender)) {
                    array_push($errors, 'SV '.$attender_file[0].' chưa đăng ký.');
                }
            }

            $schoolYearList = School_Year::orderBy('name', 'desc')->take(10)->get();
            $activityList = Activity::where('school_year_id', $schoolyear_id)->orderBy('start_date', 'desc')->get();
            $this->data['attenderList'] = $attenderList;
            $this->data['errors'] = $errors;
            $this->data['schoolyear_id'] = $schoolyear_id;
            $this->data['activity_id'] = $activity_id;
            $this->data['schoolYearList'] = $schoolYearList;
            $this->data['activityList'] = $activityList;
            $this->data['type_id'] = $request->type_id;

            return view('attender.import-mark', $this->data);
        } else {
            return redirect()->route('get_import_mark_list_route');
        }
    }

    public function postSubmitImportMarkList(Request $request) {
        $idList = $request->student_id;
        $markList = $request->mark;
        $type_id = $request->type_id;
        $activity_id = $request->type_id;

        $idList = array_values($idList);
        $markList = array_values($markList);

        DB::beginTransaction();
        try {
            for($i = 0; $i < count($idList); $i++) {
                $attender = Attender::where('student_id', $idList[$i])->where('activity_id', $activity_id)->first();

                if($type_id == 1) {
                    if($markList[$i] < 0) {
                        $attender->check = 0;
                        $attender->minus_conduct_mark = abs($markList[$i]);
                        $attender->conduct_mark = 0;
                    } else {
                        $attender->conduct_mark = $markList[$i];
                        $attender->minus_conduct_mark = 0;
                        $attender->check = 1;
                    }
                } else {
                    if($markList[$i] < 0) {
                        $attender->check = 0;
                        $attender->minus_social_mark = abs($markList[$i]);
                        $attender->social_mark = 0;
                    } else {
                        $attender->social_mark = $markList[$i];
                        $attender->minus_social_mark = 0;
                        $attender->check = 1;
                    }
                }
                $attender->save();
            }
            DB::commit();

            $schoolYearList = School_Year::orderBy('name', 'desc')->take(10)->get();
            $activity = Activity::find($request->activity_id);
            $activityList = Activity::where('school_year_id', $activity->SchoolYear->id)->orderBy('start_date', 'desc')->get();
            $attenderList = Attender::where('activity_id', $request->activity_id)->get();
            $activity_id = $request->activity_id;
            $school_year_id = $activity->SchoolYear->id;


            $this->data['attenderList'] = $attenderList;
            $this->data['schoolyear_id'] = $school_year_id;
            $this->data['activity_id'] = $activity_id;
            $this->data['schoolYearList'] = $schoolYearList;
            $this->data['activityList'] = $activityList;

            session($this->data);

            // return view('attender.index', $this->data);
            return redirect()->route('get_attender_index_route');
        } catch(Exception $e) {
            DB::rollBack();

            $this->data['error'] = $e->getMessage();
            return $this->data;
        }
    }

    public function postExportExcelAttenderList(Request $request) {
        $activity_id = $request->activity_id;
        $attenderList = Attender::where('activity_id', $activity_id)->get();

        $excelFile = Excel::create('DS_Tham_Gia', function($excel) use($attenderList) {
            $excel->sheet('DS_Tham_Gia', function($sheet) use($attenderList) {
                $sheet->row(1, array(
                    'MSSV', 'Họ tên', 'ĐRL', 'Điểm CTXH'
                ));

                foreach($attenderList as $attender) {
                    $row_data = array();

                    array_push($row_data, $attender['id']);
                    array_push($row_data, $attender['name']);
                    array_push($row_data, $attender['conduct_mark']);
                    array_push($row_data, $attender['social_mark']);

                    $sheet->appendRow($row_data);
                }
                $sheet->setFontSize(13);
                $sheet->setFontFamily('Times New Roman');
                $sheet->row(1, function($row) {
                    $row->setFontWeight('bold');
                });
            });
        })->string('xlsx');

        $response =  array(
            'name' => 'DS_Tham_Gia'.'.xlsx', //no extention needed
            'file' => "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,".base64_encode($excelFile)
        );

        return response()->json($response);
    }
}
