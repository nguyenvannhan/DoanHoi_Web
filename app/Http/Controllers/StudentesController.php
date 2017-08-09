<?php

namespace App\Http\Controllers;

use App\Classes;
use App\Science;
use App\Studentes;
use Illuminate\Http\Request;

class StudentesController extends Controller
{
    public function getStudentList() {
        $studentList = Studentes::with('Classes')->orderBy('mssv', 'desc')->get();
        $classList = Classes::orderBy('id', 'desc')->get();

        return view('student.studentList', ['classList' => $classList, 'studentList' => $studentList]);
    }
    public function getAddStudentList(){
    	$studentList = Studentes::with('Classes')->orderBy('mssv', 'desc')->get();
        $classList = Classes::orderBy('id', 'desc')->get();
    	$scienceList=Science::orderBy('id','desc')->get();

    	return view('student.addStudent', ['classList' => $classList, 'studentList' => $studentList,'scienceList'=>$scienceList]);
    }
    public function getInfoStudent($mssv){
    	$studentOb = Studentes::find($mssv);

        return response()->json(['studentOb' => $studentOb]);
    }
    public function postAddStudent(Request $request){
        $studentOb = new Studentes;
        $studentOb->mssv = $request->txtmssv;
        $studentOb->student_name = $request->txtname_student;
        $studentOb->classId=$request->slclass;
        $studentOb->scieneId=$request->slscience;
        $studentOb->is_female=$request->slGT;
        $studentOb->is_doanvien=$request->slDoanVien;
        $studentOb->is_dangvien=$request->slDangVien;
        $studentOb->hometown=$request->txthome;
        $studentOb->number_phone=$request->txtsdt;
        $studentOb->birthday=date('y-m-d', strtotime( $request->txtbirth ));
        $studentOb->email=$request->txtemail;
        $studentOb->diem_ctxh=$request->txtctxh;
        $studentOb->status=$request->slTTSV;

        $studentOb->save();

        return redirect('/student')->with(['success_alert' => 'Thêm Sinh Viên Thành Công']);
    }
}
