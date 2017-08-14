<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BCH_Khoa;
use App\Studentes;
use App\School_Yeares;

class BCH_KhoaController extends Controller
{
     public function getBCH_KhoaList() {
        $bch_khoaList = BCH_Khoa::with('School_Yeares')->orderBy('id', 'desc')->get();
        $studentList = Studentes::orderBy('mssv', 'desc')->get();

        return view('BCH_Khoa.BCH_KhoaList', ['studentList' => $studentList, 'bch_khoaList' => $bch_khoaList]);
    }
}
