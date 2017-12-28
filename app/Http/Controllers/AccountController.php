<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Student;


class AccountController extends Controller
{
    public function index() {
        $accountList = User::getAccountList();

        $this->data['accountList'] = $accountList;

        return view('account.index', $this->data);
    }

    public function postCreateAccount(Request $request) {
        $student = Student::find($request->student_id);
        if(!is_null($student) && $student->email != null && $student->email != '') {
            $password = "123456";

            $data = [
                'student_id' => $student->id,
                'password' => bcrypt($password),
                'level' => $request->level,
                'remember_token' => $request->_token
            ];

            $account = User::where('student_id', $student->id)->first();
            if(is_null($account)) {

                User::create($data);

                return redirect('/tai-khoan')->with(['success_alert' => 'Tạo tài khoản thành công.']);
            } else {
                return redirect()->back()->with('errorST', 'MSSV đã có tài khoản rồi!');
            }
        } else {
            return redirect()->back()->with('errorST', 'MSSV không đúng hoặc email sinh viên chưa đúng!');
        }
    }

    public function postDeleteAccount(Request $request) {
        $account = User::find($request->id);
        $account->delete();

        return response()->json(['result' => true]);
    }
}
