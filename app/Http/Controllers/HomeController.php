<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Science;
use App\Models\Student;
use App\Models\Activity;
use Auth;
class HomeController extends Controller
{
    /**
    * Create a new controller instance.
    *
    * @return void
    */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
    * Show the application dashboard.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        if(Auth::check()) {
            $current_date = date('Y-m-d');
            $science_arr = Science::orderBy('name', 'desc')->take(4)->get();
            $studentGroupScience = Student::with('Science')->orderBy('science_id', 'desc')->where('status', 1)->get();
            $this->data['activityList'] = Activity::with('Attenders')->where('start_date', '>=', $current_date)->orderBy('start_date', 'desc')->get();
            $this->data['studentGroupScience'] = $studentGroupScience;
            $this->data['science_arr'] = $science_arr;

            return view('admin', $this->data);
        } else {
            return redirect()->route('get_login_route');
        }
    }

    public function getLogin() {
        if(Auth::check()) {
            return redirect()->route('home');
        } else {
            return view('auth.login');
        }
    }

    public function postLogin(Request $request) {
        $account = [
            'student_id' => $request->student_id,
            'password' => $request->password
        ];
        $remember = $request->remember;

        if(Auth::attempt($account, $remember)) {
            return redirect()->route('home');
        } else {
            return redirect()->back()->with('error', 'MSSV hoặc Password không đúng');
        }
    }

    public function getLogout() {
        Auth::logout();
        return redirect()->route('get_login_route');
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

    public function getAccount() {
        return view('auth.register');
    }
}
