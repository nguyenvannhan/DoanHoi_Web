<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Science;
use App\Models\Student;
use App\Models\Activity;
use Auth;
use Hash;
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

    public function profile() {
        if(Auth::user()->level == 0) {
            return redirect()->back();
        } else {
            return redirect()->route('get_edit_student_route', ['id' => Auth::user()->student_id]);
        }
    }

    public function getChangePass() {
        return view('account.change_pass');
    }

    public function postChangePass(Request $request) {
        $currentPass = $request->current_pass;
        $confirmPass = $request->confirm_pass;
        $newPass = $request->new_pass;

        $errors = [];

        if(strlen($currentPass) == 0 || strlen($confirmPass) == 0 || strlen($newPass) == 0) {
            array_push($errors, 'Vui lòng điền đầy đủ thông tin');
        } else {
            $account = Auth::user();
            $currentPass_db = $account->password;

            if(!Hash::check($currentPass, $currentPass_db)) {
                array_push($errors, 'Mật khẩu hiện tại không đúng.');
            }

            if(strlen($newPass) < 8) {
                array_push($errors, 'Mật khẩu được kiến nghị từ 8 ký tự trở lên.');
            }

            if($newPass != $confirmPass) {
                array_push($errors, 'Nhập lại mật khẩu không đúng.');
            }
        }

        $this->data['errors'] = $errors;
        if(count($errors) > 0) {
            $this->data['currentPass'] = $currentPass;
            $this->data['newPass'] = $newPass;
            $this->data['confirmPass'] = $confirmPass;
            return view('account.change_pass')->with($this->data);

        } else {

            $account->password = bcrypt($newPass);
            $account->save();

            Auth::logout();
            return redirect()->route('get_login_route');
        }
    }
}
