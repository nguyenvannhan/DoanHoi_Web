<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BCH_Khoa;
use App\Studentes;
use App\School_Yeares;

class BCH_KhoaController extends Controller
{
    public function getBCH_KhoaList($BCH_KhoaId = 0) {
        if($BCH_KhoaId == 0){
            $bch_khoaLast = BCH_Khoa::orderBy('id', 'desc')->first();
            $bch_khoaList = BCH_Khoa::orderBy('id', 'desc')->get();
            $studentList = Studentes::orderBy('mssv', 'asc')->get();
           	return view('BCH_Khoa.BCH_KhoaList', ['studentList' => $studentList,'bch_khoaList'=>$bch_khoaList,'bch_khoaLast'=>$bch_khoaLast]);
       }
       else{
            $bch_khoaLast = BCH_Khoa::where('id', $BCH_KhoaId)->orderBy('id', 'desc')->first();
            $bch_khoaList = BCH_Khoa::orderBy('id', 'desc')->get();
            $studentList = Studentes::orderBy('mssv', 'asc')->get();
            return view('BCH_Khoa.BCH_KhoaList', ['studentList' => $studentList,'bch_khoaList'=>$bch_khoaList,'bch_khoaLast'=>$bch_khoaLast]);
       }
    }

    public function getAddBCH_Khoa_Student() {
        $bch_khoaList = BCH_Khoa::orderBy('id', 'desc')->get();
        $studentList = Studentes::orderBy('mssv', 'asc')->get();
       	return view('BCH_Khoa.addBCH_Khoa', ['studentList' => $studentList,'bch_khoaList'=>$bch_khoaList]);
    }

    public function postAddBCH_Khoa_Student(Request $request){
        $bch_khoa=BCH_Khoa::find($request->slbch_khoa);
        $mssv=$request->slmssv;
        $position=$request->slposition;
        $iscb_doan=$request->sliscbdoan;
        $bch_khoa->Studentes()->attach([$mssv=>['position'=>$position,'is_cbdoan'=>$iscb_doan]]);

         return redirect('/BCH-Khoa')->with(['success_alert' => 'Thêm Thành Viên Thành Công']);
    }

    public function getAjaxAddBCH_khoa(){
        $bch_khoaLast = BCH_Khoa::orderBy('id', 'desc')->first();
        $School_YearLast=School_Yeares::orderBy('id', 'desc')->first();
        if($School_YearLast->id > $bch_khoaLast->school_yearId){
            $bch_khoa=new BCH_Khoa;
            $school_yearidnew=$bch_khoaLast->school_yearId+1;
            $bch_khoa->school_yearId=$school_yearidnew;
            $bch_khoa->save();

        $bch_khoaList = BCH_Khoa::orderBy('id', 'desc')->get();
            foreach ($bch_khoaList as $bch_khoaOb) {
                echo '
                    <option value="'.$bch_khoaOb->id.'">' .$bch_khoaOb->School_Yeares->school_year_name. '</option>';
            }
        }
    }

    
}
