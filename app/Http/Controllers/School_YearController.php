<?php

namespace App\Http\Controllers;

use App\Models\School_Year;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class School_YearController extends Controller {

     public function getAllList() {
        $this->data['school_year_list'] = School_Year::orderBy('name','desc')->get();

        return view('school_year.schoolYearList', $this->data);
    }

    public function postAjaxAddSchoolYear() {
        $topSchoolYear = School_Year::orderBy('id', 'desc')->take(1)->first();
        $endSchoolName = substr($topSchoolYear->name, -2);


        $namhoc = '20'.$endSchoolName.' - 20'.($endSchoolName + 1);

        $school_yearob = new School_Year;
        $school_yearob->name = $namhoc;
        $school_yearob->save();

        $this->data['school_year_list'] = School_Year::orderBy('name','desc')->get();

        return response()->view('school_year.ajax-school-year-list', $this->data);
    }
}
