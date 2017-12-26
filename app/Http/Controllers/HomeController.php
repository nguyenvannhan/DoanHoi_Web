<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function AdminDashboard() {
        $current_date = date('Y-m-d');
        $science_arr = Science::orderBy('name', 'desc')->take(4)->get();
        $studentGroupScience = Student::with('Science')->orderBy('science_id', 'desc')->where('status', 1)->get();
        $this->data['activityList'] = Activity::with('Attenders')->where('start_date', '>=', $current_date)->orderBy('start_date', 'desc')->get();
        $this->data['studentGroupScience'] = $studentGroupScience;
        $this->data['science_arr'] = $science_arr;
        return view('admin', $this->data);
    }
}
