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

    public function getEditStudent($mssv){
        $student = Studentes::with('Classes')->where('mssv', $mssv)->first(); //Cho nay tu orderby tro di e bo dc ak Dai. Xai first() thoi la dc. Ben file blade khi do ko can foreach
        $classList = Classes::orderBy('id', 'desc')->get();
        $scienceList=Science::orderBy('id','desc')->get();

        return view('student.editStudent', ['classList'=>$classList,'student'=>$student,'scienceList'=>$scienceList]);
    }

    public function postEditStudent(Request $request, $mssv)
    {
        $studentOb=Studentes::find($mssv);

        $studentOb->mssv = $request->txtEditmssv;
        $studentOb->student_name = $request->txtEditname_student;
        $studentOb->classId=$request->slclass;
        $studentOb->scienceId=$request->slscience;
        $studentOb->is_female=$request->slEditGT;
        $studentOb->is_doanvien=$request->slEditDoanVien;
        $studentOb->is_dangvien=$request->slEditDangVien;
        $studentOb->hometown=$request->txtEdithome;
        $studentOb->number_phone=$request->txtEditsdt;
        $studentOb->birthday=date('y-m-d', strtotime( $request->txtEditbirth ));
        $studentOb->email=$request->txtEditemail;
        $studentOb->diem_ctxh=$request->txtEditctxh;
        $studentOb->status=$request->slEditTTSV;

        $studentOb->save();

        return redirect('/student')->with(['success_alert' => 'Cập nhật thông tin sinh viên thành công!']);
    }

    public function postAddStudent(Request $request){
        $studentOb = new Studentes;

        $studentOb->mssv = $request->txtmssv;
        $studentOb->student_name = $request->txtname_student;
        $studentOb->classId=$request->slclass;
        $studentOb->scienceId=$request->slscience;
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

    public function getDeleteStudent($mssv) {
        $studentOb=Studentes::find($mssv);
        $studentOb->delete();

        return redirect('/student')->with(['success_alert' => 'Xóa Sinh Viên thành công!']);
    }

    public function getAjaxSearchStudent($searchKey) {
        $studentList = Studentes::where('mssv', 'LIKE', '%'.$searchKey.'%')->orWhere('student_name', 'LIKE', '%'.$searchKey.'%')->get();

        return response()->json(['studentList' => $studentList]);
    }

    public function getClassFromId($studentId) {
        $student = Studentes::find($studentId)->first();
        return response()->json(['classOb' => $student->Classes]);
    }
}
