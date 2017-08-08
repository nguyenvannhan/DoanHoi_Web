<?php

namespace App\Http\Controllers;

use App\School_Yeares;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class School_YearesController extends Controller
{
     public function getAllList() {
        $school_yearList = School_Yeares::orderBy('school_year_name','desc')->get();

        return view('school_year.schoolYearList', ['school_yearList' => $school_yearList]);
    }
    public function AddSchool_Year(Request $request) {
      $namhoc= $request->txtNamHoc;
      $school_yearob = new School_Yeares;
      $school_yearob->school_year_name = $namhoc;
      $school_yearob->save();
      return redirect('/school-year')->with(['success_alert' => 'Thêm Năm Học Thành Công']);
    }
}
