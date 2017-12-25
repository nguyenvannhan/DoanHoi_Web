<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Science;
use App\Models\Student;
use DB;
use Illuminate\Http\Request;

class HomeController extends Controller {
    public function index() {
        $current_date = date('Y-m-d');
        $science_arr = Science::orderBy('name', 'desc')->take(4)->get();
        $studentGroupScience = Student::with('Science')->orderBy('science_id', 'desc')->where('status', 1)->get();

        $this->data['activityList'] = Activity::with('Attenders')->where('start_date', '>=', $current_date)->orderBy('start_date', 'desc')->get();
        $this->data['studentGroupScience'] = $studentGroupScience;
        $this->data['science_arr'] = $science_arr;


        return view('admin', $this->data);
    }
}
