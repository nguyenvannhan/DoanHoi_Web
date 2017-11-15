<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Config;

use App\Models\Classes;
use App\Models\Science;
use App\Models\Student;
use App\Models\Faculty;
use App\Http\Requests\AddStudentRequest;
use Illuminate\Http\Request;

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
        $this->data['student'] = Student::with('ClassOb', 'Faculty')->find($id);
        $this->data['scienceList'] = Science::orderBy('id','desc')->get();

        if($this->data['student']->is_it_student) {
            $this->data['classList'] = Classes::orderBy('id', 'desc')->get();
        } else {
            $this->data['facultyList'] = Faculty::orderBy('id', 'desc')->get();
        }

        return view('student.editStudent', $this->data);
    }

    public function postEditStudent(Request $request, $id)
    {
        $studentOb=Student::find($id);

        // $studentOb->mssv = $request->txtEditmssv;
        // $studentOb->student_name = $request->txtEditname_student;
        // $studentOb->classId=$request->slclass;
        // $studentOb->scienceId=$request->slscience;
        // $studentOb->is_female=$request->slEditGT;
        // $studentOb->is_doanvien=$request->slEditDoanVien;
        // $studentOb->is_dangvien=$request->slEditDangVien;
        // $studentOb->hometown=$request->txtEdithome;
        // $studentOb->number_phone=$request->txtEditsdt;
        // $studentOb->birthday=date('y-m-d', strtotime( $request->txtEditbirth ));
        // $studentOb->email=$request->txtEditemail;
        // $studentOb->diem_ctxh=$request->txtEditctxh;
        // $studentOb->status=$request->slEditTTSV;
        //
        // $studentOb->save();
        //
        // return redirect('/student')->with(['success_alert' => 'Cập nhật thông tin sinh viên thành công!']);
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
        $studentOb->birthday=date('y-m-d', strtotime( $request->txtEditbirth ));
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

    public function getDeleteStudent($id) {
        $studentOb=Student::find($id);
        $studentOb->delete();

        return redirect('/student')->with(['success_alert' => 'Xóa Sinh Viên thành công!']);
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
