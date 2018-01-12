<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Student;
use Mail;
use DB;
use Exception;
use Auth;

class AccountController extends Controller
{
    public function index() {
        $accountList = User::getAccountList();

        $this->data['accountList'] = $accountList;

        return view('account.index', $this->data);
    }

    public function postCreateAccount(Request $request) {
        DB::beginTransaction();
        try {
            $student = Student::find($request->student_id);
            if(!is_null($student) && $student->email != null && $student->email != '') {
                $password = $this->randomPassword(10,"lower_case,upper_case,numbers,special_symbols");

                $data = [
                    'student_id' => $student->id,
                    'password' => bcrypt($password),
                    'level' => $request->level
                ];

                $account = User::where('student_id', $student->id)->first();
                if(is_null($account)) {

                    User::create($data);
                    $email_to = $student->email;
                    Mail::send('email_template.create_account', ['password' => $password], function($message) use($email_to) {
                        $message->from('doanhoiitspkt@gmail.com', 'Đoàn Hội IT SPKT');
                        $message->to($email_to);
                        $message->subject('TẠO TÀI KHOẢN WEBAPP ĐOÀN HỘI KHOA CNTT - SƯ PHẠM KỸ THUẬT TP.HCM');
                        $message->cc('doanhoiitspkt@gmail.com');
                    });

                    DB::commit();

                    return redirect('/tai-khoan')->with(['success_alert' => 'Tạo tài khoản thành công.']);
                } else {
                    return redirect()->back()->with('errorST', 'MSSV đã có tài khoản rồi!');
                }
            } else {
                return redirect()->back()->with('errorST', 'MSSV không đúng hoặc email sinh viên chưa đúng!');
            }
        } catch(Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('errorST', $e->getErrorMessages());
        }
    }

    public function postResetAccount(Request $request) {
        DB::beginTransaction();
        try {
            $account = User::find($request->id);

            if(!is_null($account)) {
                $password = $this->randomPassword(10, "lower_case,upper_case,numbers,special_symbols");
                $account->password = bcrypt($password);
                $email_to = $account->Student->email;
                $account->save();

                Mail::send('email_template.reset_account', ['password' => $password], function($message) use($email_to) {
                    $message->from('doanhoiit@cyu.syslife.info', 'Đoàn Hội IT SPKT');
                    $message->to($email_to);
                    $message->subject('RESET MẬT KHẨU TÀI KHOẢN WEBAPP ĐOÀN HỘI KHOA CNTT - SƯ PHẠM KỸ THUẬT TP.HCM');
                    $message->cc('doanhoiitspkt@gmail.com');
                });

                DB::commit();
                return response()->json(['result' => true]);
            } else {
                return response()->json(['result' => false, 'error' => 'Không tìm thấy tài khoản!!!']);
            }
        } catch(Exception $e) {
            DB::rollBack();

            return response()->json(['errorST' => 'Đã xảy ra lỗi']);
        }
    }

    public function postDeleteAccount(Request $request) {
        DB::beginTransaction();
        try {
            $account = User::find($request->id);

            if(!is_null($account)) {
                $account->delete();
                if(Auth::user()->level != 0) {
                    Mail::send('email_template.delete_account', ['account' => $account], function($message) {
                        $message->from('doanhoiitspkt@gmail.com', 'Đoàn Hội IT SPKT');
                        $message->to('doanhoiitspkt@gmail.com');
                        $message->subject('XÓA TÀI KHOẢN WEBAPP ĐOÀN HỘI KHOA CNTT - SƯ PHẠM KỸ THUẬT TP.HCM');
                    });
                }

                DB::commit();

                return response()->json(['result' => true]);
            } else {
                DB::rollBack();

                return response()->json(['error' => 'Đã xảy ra lỗi']);
            }
        } catch(Exception $e) {
            DB::rollBack();

            return response()->json(['error' => 'Đã xảy ra lỗi']);
        }
    }

    public function randomPassword($length, $characters) {

        // $length - the length of the generated password
        // $characters - types of characters to be used in the password

        // define variables used within the function
        $symbols = array();
        $used_symbols = '';
        $pass = '';

        // an array of different character types
        $symbols["lower_case"] = 'abcdefghijklmnopqrstuvwxyz';
        $symbols["upper_case"] = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $symbols["numbers"] = '1234567890';
        $symbols["special_symbols"] = '!?~@#-_+<>[]{}';

            $characters = explode(",",$characters); // get characters types to be used for the passsword
            foreach ($characters as $key=>$value) {
                $used_symbols .= $symbols[$value]; // build a string with all characters
            }
            $symbols_length = strlen($used_symbols) - 1; //strlen starts from 0 so to get number of characters deduct 1

            for ($i = 0; $i < $length; $i++) {
                $n = rand(0, $symbols_length); // get a random character from the string with all characters
                $pass .= $used_symbols[$n]; // add the character to the password string
            }

            return $pass; // return the generated password
        }
    }
