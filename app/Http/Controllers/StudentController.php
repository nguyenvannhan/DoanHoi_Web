<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Config;

use App\Models\Classes;
use App\Models\Science;
use App\Models\Student;
use App\Models\Faculty;

use App\Http\Requests\EditStudentRequest;
use App\Http\Requests\AddStudentRequest;
use Illuminate\Http\Request;
use \Carbon\Carbon;
use Excel;
use File;

class StudentController extends Controller {

    public function getStudentList() {
        $this->data['studentList'] = Student::with('ClassOb', 'Science')->where('is_it_student', 1)->get();
        $this->data['classList'] = Classes::orderBy('name', 'desc')->get();

        return view('student.studentList', $this->data);
    }

    public function getAddStudent() {
        $this->data['scienceList'] = Science::orderBy('id','desc')->get();
        $this->data['facultyList'] = Faculty::where('id', config('constants.IT_FACULTY_ID'))->get();

        return view('student.addStudent', $this->data);
    }

    public function getInfoStudent($id){
        $studentOb = Student::find($id);

        return response()->json(['studentOb' => $studentOb]);
    }

    public function getEditStudent($id){
        $student = Student::with('ClassOb', 'Faculty')->find($id);
        $this->data['student'] = $student;
        $this->data['scienceList'] = Science::orderBy('id','desc')->get();

        if($student->is_it_student) {
            $this->data['classList'] = Classes::where('science_id', $student->science_id)->orderBy('id', 'desc')->get();
        } else {
            $this->data['facultyList'] = Faculty::orderBy('id', 'desc')->get();
        }

        return view('student.editStudent', $this->data);
    }

    public function postEditStudent($id, EditStudentRequest $request)
    {
        $studentOb=Student::find($id);

        $studentOb->id = $request->id;
        $studentOb->name = $request->name;
        $studentOb->class_id = $request->class_id;
        $studentOb->science_id = $request->science_id;
        if($request->is_it_student) {
            $studentOb->is_it_student = $request->is_it_student;
        } else {
            $studentOb->is_it_student = 0;
        }
        $studentOb->is_female = $request->gender;
        if($request->is_cyu != 1) {
            $studentOb->is_cyu = 0;
        } else {
            $studentOb->is_cyu=$request->is_cyu;
        }
        if($request->is_partisan != 1) {
            $studentOb->is_partisan=0;
        } else {
            $studentOb->is_partisan = $request->is_partisan;
        }
        $studentOb->hometown=$request->hometown;
        $studentOb->number_phone=$request->numberphone;
        if($request->birthday) {
            $studentOb->birthday = Carbon::createFromFormat('d/m/Y', $request->birthday)->format('Y-m-d');
        }
        $studentOb->email=$request->email;
        $studentOb->social_mark = 0;
        $studentOb->status=$request->status;
        if($request->is_it_student == 1) {
            $studentOb->faculty_id  = 1;
        } else {
            $studentOb->faculty_id  = $request->faculty_id;
        }


        $studentOb->save();

        return redirect()->route('student_index_route');
    }

    public function postAddStudent(AddStudentRequest $request) {
        $studentOb = new Student;

        $studentOb->id = $request->id;
        $studentOb->name = $request->name;
        $studentOb->class_id = $request->class_id;
        $studentOb->science_id = $request->science_id;
        if($request->is_it_student) {
            $studentOb->is_it_student = $request->is_it_student;
        } else {
            $studentOb->is_it_student = 0;
        }
        $studentOb->is_female = $request->gender;
        if($request->is_cyu != 1) {
            $studentOb->is_cyu = 0;
        } else {
            $studentOb->is_cyu=$request->is_cyu;
        }
        if($request->is_partisan != 1) {
            $studentOb->is_partisan=0;
        } else {
            $studentOb->is_partisan = $request->is_partisan;
        }
        $studentOb->hometown=$request->hometown;
        $studentOb->number_phone=$request->numberphone;
        if($request->birthday) {
            $studentOb->birthday = Carbon::createFromFormat('d/m/Y', $request->birthday)->format('Y-m-d');
        }
        $studentOb->email=$request->email;
        $studentOb->social_mark = 0;
        $studentOb->status=$request->status;
        if($request->is_it_student == 1) {
            $studentOb->faculty_id  = 1;
        } else {
            $studentOb->faculty_id  = $request->faculty_id;
        }

        $studentOb->save();

        return redirect()->route('student_index_route');
    }

    public function postDeleteStudent(Request $request) {
        $studentOb=Student::find($request->id);
        $studentOb->delete();

        $this->data['studentList'] = Student::with('ClassOb', 'Science')->where('is_it_student', 1)->get();

        return response()->view('student.student-list-table', $this->data);
    }

    public function ajaxGetInfoAddStudent($is_it_student, $science_id = 0) {
        if($is_it_student) {
            $this->data['classList'] = Classes::where('science_id', $science_id)->orderBy('id', 'desc')->get();
            $this->data['faculty'] = Faculty::find(config('constants.IT_FACULTY_ID'));

            return response()->json($this->data);
        } else {
            $this->data['facultyList'] = Faculty::where('id', '<>', config('constants.IT_FACULTY_ID'))->get();
            return response()->json($this->data);
        }
    }

    public function ajaxGetStudentList($type_id) {
        $studentList = Student::orderBy('id', 'desc');

        if($type_id != -1) {
            $studentList = $studentList->where('is_it_student', $type_id);
        }

        $this->data['studentList'] = $studentList->with('ClassOb', 'Faculty', 'Science')->get();
        $this->data['type_id'] = $type_id;

        return response()->view('student.student-list-table', $this->data);
    }

    public function ajaxGetStudentInfo($id) {
        $this->data['student'] = Student::find($id);

        return response()->view('student.student-detail-modal', $this->data);
    }

    public function getAddList() {
        return view('student.addListStudent');
    }

    public function postAddList(Request $request) {
        //Read Excell
        if($request->hasFile('import')) {
            $result = Excel::load($request->import, function($reader){})->get()->toArray();
            $studentList = [];

            foreach($result as $student) {
                $student = array_values($student);
                $newStudent = new Student;
                $newStudent->id = $student[1];
                $newStudent->name = $student[2];
                if($student[3] == NULL) {
                    $newStudent->is_female = 0;
                } else {
                    $newStudent->is_female = 1;
                }
                $newStudent->birthday = Carbon::createFromFormat('d/m/Y', $student[4])->format('Y-m-d');
                $newStudent->hometown = $student[5];
                $newStudent->email = $student[6];
                $newStudent->number_phone = $student[7];
                $newStudent->science_id = $student[8];
                $newStudent->class_id = $student[9];
                $newStudent->faculty_id = 1;

                array_push($studentList, $newStudent);
            }
            // $this->data['studentList'] = $studentList;

            $errors = [];
            $class_names = [];
            $science_names = [];
            //Check error
            foreach($studentList as $student) {
                //check tồn tại sinh viên
                $check = Student::find($student->id);
                if(!is_null($check)) {
                    array_push($errors, "MSSV ".$student->id." đã tồn tại.");
                }

                $science = Science::where('name', $student->science_id)->first();
                if(is_null($science)) {
                    array_push($errors, "Khóa học của SV ".$student->id." không tồn tại.");
                    array_push($science_names, NULL);
                } else {
                    $student->science_id = $science->id;
                    array_push($science_names, $science->name);
                }

                $classOb = Classes::where('name', $student->class_id)->first();
                if(is_null($classOb)) {
                    array_push($errors, "Lớp học của SV ".$student->id." không tồn tại.");
                    array_push($class_names, NULL);
                } else {
                    $student->class_id = $classOb->id;
                    array_push($class_names, $classOb->name);
                }

                if($student->email && !filter_var($student->email, FILTER_VALIDATE_EMAIL)) {
                    array_push($errors, "Email của SV ".$student->id." không đúng.");
                }

                if($student->number_phone && !ctype_alpha($student->number_phone)) {
                    array_push($errors, "SĐT của SV ".$student->id." không đúng.");
                }
            }

            $this->data['studentList'] = $studentList;
            $this->data['errors'] = $errors;
            $this->data['class_names'] = $class_names;
            $this->data['science_names'] = $science_names;

            return view('student.addListStudent', $this->data);
        }
        return redirect()->route('student_get_add_list_route');
    }
}
