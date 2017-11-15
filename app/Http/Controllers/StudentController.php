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
        $studentOb->is_it_student = $request->is_it_student;
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
        $studentOb->birthday= Carbon::createFromFormat('d/m/Y', $request->birthday)->format('Y-m-d');
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

    public function postAddStudent(AddStudentRequest $request){

        $studentOb = new Student;

        $studentOb->id = $request->id;
        $studentOb->name = $request->name;
        $studentOb->class_id = $request->class_id;
        $studentOb->science_id = $request->science_id;
        $studentOb->is_it_student = $request->is_it_student;
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
        $studentOb->birthday = Carbon::createFromFormat('d/m/Y', $request->birthday)->format('Y-m-d');
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

    public function getClassFromId($studentId) {
        $student = Student::find($studentId)->first();
        return response()->json(['classOb' => $student->Classes]);
    }
}
