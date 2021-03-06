<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddStudentRequest;
use App\Http\Requests\EditStudentRequest;
use App\Models\Classes;
use App\Models\Faculty;
use App\Models\Science;
use App\Models\Student;
use App\Models\Log;
use Auth;
use DB;
use Excel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use \Carbon\Carbon;

class StudentController extends Controller
{
    
    private $user;
    protected $userInfo;
    
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $user = Auth::user();
            $this->user = $user;
            $this->userInfo = is_null($user->Student) ? null : $user->Student;
            
            return $next($request);
        });
    }
    
    public function getStudentList()
    {
        if ($this->user->level == 3) {
            $this->data['studentList'] = Student::with('ClassOb', 'Science')->where('is_it_student', 1)->where('class_id', $this->userInfo->class_id)->get();
            $this->data['classList'] = Classes::where('id', $this->userInfo->class_id)->orderBy('name', 'desc')->get();
        } else {
            $this->data['studentList'] = Student::with('ClassOb', 'Science')->has('ClassOb')->where('is_it_student', 1)->get();
            $this->data['classList'] = Classes::orderBy('name', 'desc')->get();
        }
        return view('student.studentList', $this->data);
    }
    
    public function getAddStudent()
    {
        if ($this->user->level == 3) {
            $this->data['scienceList'] = Science::orderBy('id', 'desc')->where('id', $this->userInfo->science_id)->get();
            $this->data['facultyList'] = Faculty::where('id', config('constants.IT_FACULTY_ID'))->get();
        } else {
            $this->data['scienceList'] = Science::orderBy('id', 'desc')->get();
            $this->data['facultyList'] = Faculty::where('id', config('constants.IT_FACULTY_ID'))->get();
        }
        
        return view('student.addStudent', $this->data);
    }
    
    public function getInfoStudent($id)
    {
        $studentOb = Student::find($id);
        
        return response()->json(['studentOb' => $studentOb]);
    }
    
    public function getEditStudent($id)
    {
        $student = Student::with('ClassOb', 'Faculty')->find($id);
        $this->data['student'] = $student;
        if ($this->user->level == 3) {
            if ($student->class_id != $this->userInfo->class_id) {
                return redirect()->back();
            }
            $this->data['scienceList'] = Science::where('id', $this->userInfo->science_id)->get();
            $this->data['classList'] = Classes::where('id', $this->userInfo->class_id)->orderBy('id', 'desc')->get();
        } else {
            if ($student->is_it_student) {
                $this->data['scienceList'] = Science::orderBy('name', 'desc')->get();
                $this->data['classList'] = Classes::where('science_id', $student->science_id)->orderBy('id', 'desc')->get();
            } else {
                $this->data['facultyList'] = Faculty::orderBy('id', 'desc')->get();
            }
        }
        // dd($this->data['scienceList']);
        return view('student.editStudent', $this->data);
    }
    
    public function postEditStudent($id, EditStudentRequest $request)
    {
        $studentOb = Student::find($id);
        if ($this->user->level == 3 && $studentOb->class_id != $this->userInfo->class_id) {
            return redirect()->back();
        }
        
        $old_data = $studentOb->id.'<br/>';
        $new_data = $studentOb->id.'<br/>';
        
        if($studentOb->name != $request->name) {
            $old_data .= 'Tên: '.$studentOb->name.'<br/>';
            $new_data .= 'Tên: '.$request->name.'<br/>';
            
            $studentOb->name = $request->name;
        }
        if($studentOb->class_id != $request->class_id) {
            $old_data .= 'Lớp: '.$studentOb->class_id.'<br/>';
            $new_data .= 'Lớp: '.$request->class_id.'<br/>';
            
            $studentOb->class_id = $request->class_id;
        }
        if($studentOb->science_id != $request->science_id) {
            $old_data = 'Khóa: '.$studentOb->science_id.'<br/>';
            $new_data = 'Khóa: '.$request->science_id.'<br/>';
            
            $studentOb->science_id = $request->science_id;
        }
        if($studentOb->partisan_id != $request->partisan_id) {
            $new_data = 'Đảng viên: '.$request->partisan_id.'<br/>';
            $old_data = 'Đảng viên: '.$studentOb->partisan_id.'<br/>';
            
            $studentOb->partisan_id = $request->partisan_id;
        }
        if ($request->is_it_student) {
            $studentOb->is_it_student = $request->is_it_student;
        } else {
            $studentOb->is_it_student = 0;
        }
        $studentOb->is_female = $request->gender;
        if ($request->is_cyu != 1) {
            $studentOb->is_cyu = 0;
        } else {
            $studentOb->is_cyu = $request->is_cyu;
        }
        if($studentOb->hometown != $request->hometown) {
            $new_data = 'Quê quán: '.$request->hometown.'<br/>';
            $old_data = 'Quê quán: '.$studentOb->hometown.'<br/>';
            
            $studentOb->hometown = $request->hometown;
        }
        if($studentOb->number_phone != $request->numberphone) {
            $new_data = 'SĐT: '.$request->numberphone.'<br/>';
            $old_data = 'SĐT: '.$studentOb->number_phone.'<br/>';
            
            $studentOb->number_phone = $request->numberphone;
        }
        if ($request->birthday != null) {
            $new = Carbon::createFromFormat('d/m/Y', $request->birthday)->format('Y-m-d');
            if($studentOb->birthday != $new) {
                $new_data = 'Ngày sinh: '.$new.'<br/>';
                $old_data = 'Ngày sinh: '.$studentOb->birthday.'<br/>';
                
                $studentOb->birthday = $new;
            }
        }
        if($studentOb->email != $request->email) {
            $new_data = 'Email: '.$request->email.'<br/>';
            $old_data = 'Email: '.$studentOb->email.'<br/>';
            
            $studentOb->email = $request->email;
        }
        $studentOb->social_mark = 0;
        if($studentOb->status != $request->status) {
            $new_data .= 'TT: '.$request->status.'<br/>';
            $old_data .= 'TT: '.$studentOb->status.'<br/>';
            
            $studentOb->status = $request->status;
        }
        if ($request->is_it_student == 1) {
            if($studentOb->faculty_id != 1) {
                $old_data = 'Khoa: '.$studentOb->faculty_id.'<br/>';
                $new_data = 'Khoa: 1'.'<br/>';
                
                $studentOb->faculty_id = 1;
            }
        } else {
            if($request->faculty_id != $studentOb->faculty_id) {
                $new_data = 'Khoa:'.$request->faculty_id.'<br/>';
                $old_data = 'Khoa:'.$studentOb->faculty_id.'<br/>';
                
                $studentOb->faculty_id = $request->faculty_id;
            }
        }
        
        if ($request->is_cyu == 1) {
            if($studentOb->workplace_union_old != $request->workplace_union_old) {
                $new_data .= 'Nơi SH cũ: '.$request->workplace_union_old.'<br/>';
                $old_data .= 'Nơi SH cũ: '.$studentOb->workplace_union_old.'<br/>';
                
                $studentOb->workplace_union_old = $request->workplace_union_old;
            }
            
            if ($request->date_set_union != null) {
                $new = Carbon::createFromFormat('d/m/Y', $request->date_set_union)->format('Y-m-d');
                if($studentOb->date_set_union != $new) {
                    $new_data .= 'Ngày KN Đoàn: '.$new.'<br/>';
                    $old_data .= 'Ngày KN Đoàn: '.$studentOb->date_set_union.'<br/>';
                    
                    $studentOb->date_set_union = $new;
                }
            } else {
                if(!is_null($studentOb->date_set_union)) {
                    $new_data .= 'Ngày nộp sổ Đoàn: NULL'.'<br/>';
                    $old_data .= 'Ngày nộp sổ  Đoàn: '.$student->date_set_union.'<br/>';
                    
                    $studentOb->date_set_union = null;
                }
            }
            if($studentOb->place_on_union != $request->place_on_uinon) {
                $new_data .= 'Nơi KN Đoàn: '.$request->place_on_uinon.'<br/>';
                $old_data .= 'Nơi KN Đoàn: '.$studentOb->place_on_union.'<br/>';
                
                $studentOb->place_on_union = $request->place_on_union;
            }
            if ($request->date_on_union != null) {
                $new = Carbon::createFromFormat('d/m/Y', $request->date_on_union)->format('Y-m-d');
                
                if($studentOb->date_on_union != $new) {
                    $new_data .= 'Ngày KN Đoàn: '.$new.'<br/>';
                    $old_data .= 'Ngày KN Đoàn: '.$studentOb->date_on_union.'<br/>';
                    
                    $studentOb->date_on_union = $new;
                }
                
            } else {
                if(!is_null($studentOb->date_on_union)) {
                    $new_data .= 'Ngày KN Đoàn: NULL'.'<br/>';
                    $old_data .= 'Ngày KN Đoàn: '.$studentOb->date_on_union.'<br/>';
                    
                    $studentOb->date_on_union = null;
                }
            }
        }
        
        $studentOb->save();
        
        Log::AddToLog('Cập nhật sinh viên', $old_data, $new_data);
        
        return redirect()->route('student_index_route');
    }
    
    public function postAddStudent(AddStudentRequest $request)
    {
        $studentOb = new Student;
        
        $studentOb->id = $request->id;
        $studentOb->name = $request->name;
        $studentOb->class_id = $request->class_id;
        $studentOb->science_id = $request->science_id;
        $studentOb->partisan_id = $request->partisan_id;
        if ($request->is_it_student) {
            $studentOb->is_it_student = $request->is_it_student;
        } else {
            $studentOb->is_it_student = 0;
        }
        $studentOb->is_female = $request->gender;
        if ($request->is_cyu != 1) {
            $studentOb->is_cyu = 0;
        } else {
            $studentOb->is_cyu = $request->is_cyu;
        }
        $studentOb->hometown = $request->hometown;
        $studentOb->number_phone = $request->numberphone;
        if ($request->birthday != null) {
            $studentOb->birthday = Carbon::createFromFormat('d/m/Y', $request->birthday)->format('Y-m-d');
        }
        $studentOb->email = $request->email;
        $studentOb->social_mark = 0;
        $studentOb->status = $request->status;
        if ($request->is_it_student == 1) {
            $studentOb->faculty_id = 1;
        } else {
            $studentOb->faculty_id = $request->faculty_id;
        }
        
        if ($request->is_cyu == 1) {
            $studentOb->workplace_union_old = $request->workplace_union_old;
            if ($request->date_set_union != null) {
                $studentOb->date_set_union = Carbon::createFromFormat('d/m/Y', $request->date_set_union)->format('Y-m-d');
            } else {
                $studentOb->date_set_union = null;
            }
            $studentOb->place_on_union = $request->place_on_union;
            if ($request->date_on_union != null) {
                $studentOb->date_on_union = Carbon::createFromFormat('d/m/Y', $request->date_on_union)->format('Y-m-d');
            } else {
                $studentOb->date_on_union = null;
            }
        }
        
        $studentOb->save();
        
        Log::AddToLog('Thêm sinh viên', '', $studentOb->id.' - '.$studentOb->name);
        
        return redirect()->route('student_index_route');
    }
    
    public function postDeleteStudent(Request $request)
    {
        $studentOb = Student::find($request->id);
        $studentOb->delete();
        
        Log::AddToLog('Xóa sinh viên', $studentOb->id.' - '.$studentOb->name, '');
        
        $this->data['studentList'] = Student::with(['ClassOb', 'Science'])->where('is_it_student', 1)->get();
        $this->data['type_id'] = $request->type_id;
        
        Log::AddToLog('Thêm sinh viên', '', $studentOb->id.' - '.$studentOb->name);
        
        return response()->view('student.student-list-table', $this->data);
    }
    
    public function ajaxGetInfoAddStudent($is_it_student, $science_id = 0)
    {
        if ($this->user->level == 3) {
            $this->data['classList'] = Classes::where('id', $this->userInfo->class_id)->orderBy('id', 'desc')->get();
            $this->data['faculty'] = Faculty::find(config('constants.IT_FACULTY_ID'));
            return response()->json($this->data);
        } else {
            if ($is_it_student) {
                $this->data['classList'] = Classes::where('science_id', $science_id)->orderBy('id', 'desc')->get();
                $this->data['faculty'] = Faculty::find(config('constants.IT_FACULTY_ID'));
                
                return response()->json($this->data);
            } else {
                $this->data['facultyList'] = Faculty::where('id', '<>', config('constants.IT_FACULTY_ID'))->get();
                return response()->json($this->data);
            }
        }
    }
    
    public function ajaxGetStudentList($type_id)
    {
        $studentList = Student::orderBy('id', 'desc');
        
        if ($type_id != -1) {
            $studentList = $studentList->where('is_it_student', $type_id);
        }
        
        $this->data['studentList'] = $studentList->has('ClassOb')->with('ClassOb', 'Faculty', 'Science')->get();
        $this->data['type_id'] = $type_id;
        
        return response()->view('student.student-list-table', $this->data);
    }
    
    public function ajaxGetStudentInfo($id)
    {
        $this->data['student'] = Student::find($id);
        
        return response()->view('student.student-detail-modal', $this->data);
    }
    
    public function getAddList()
    {
        return view('student.addListStudent');
    }
    
    public function postAddList(Request $request)
    {
        //Read Excell
        if ($request->hasFile('import')) {
            $result = Excel::load($request->import, function ($reader) {
            })->get()->toArray();
            $studentList = [];
            
            foreach ($result as $student) {
                $student = array_values($student);
                $newStudent = new Student;
                $newStudent->id = $student[0];
                $newStudent->name = $student[1];
                if ($student[2] == null) {
                    $newStudent->is_female = 0;
                } else {
                    $newStudent->is_female = 1;
                }
                if ($student[3] != null) {
                    $newStudent->birthday = Carbon::createFromFormat('d/m/Y', $student[3])->format('Y-m-d');
                } else {
                    $newStudent->birthday = null;
                }
                $newStudent->hometown = $student[4];
                $newStudent->email = $student[5];
                $newStudent->number_phone = $student[6];
                $newStudent->science_id = $student[7];
                $newStudent->class_id = $student[8];
                $newStudent->partisan_id = 0;
                if ($student[9] != null) {
                    $newStudent->is_cyu = 1;
                } else {
                    $newStudent->is_cyu = 0;
                }
                if ($student[10] != null) {
                    $newStudent->partisan_id = 1;
                }
                if ($student[11] != null) {
                    $newStudent->partisan_id = 2;
                }
                
                $newStudent->faculty_id = 1;
                
                array_push($studentList, $newStudent);
            }
            // $this->data['studentList'] = $studentList;
            
            $errors = [];
            $class_names = [];
            $science_names = [];
            //Check error
            foreach ($studentList as $student) {
                //check tồn tại sinh viên
                $check = Student::find($student->id);
                if (!is_null($check)) {
                    array_push($errors, "MSSV " . $student->id . " đã tồn tại.");
                }
                
                $science = Science::where('name', $student->science_id)->first();
                if (is_null($science)) {
                    array_push($errors, "Khóa học của SV " . $student->id . " không tồn tại.");
                    array_push($science_names, null);
                } else {
                    $student->science_id = $science->id;
                    array_push($science_names, $science->name);
                }
                
                $classOb = Classes::where('name', $student->class_id)->first();
                if (is_null($classOb)) {
                    array_push($errors, "Lớp học của SV " . $student->id . " không tồn tại.");
                    array_push($class_names, null);
                } else {
                    $student->class_id = $classOb->id;
                    array_push($class_names, $classOb->name);
                    
                    if ($this->user->level == 3 && $classOb->id != $this->userInfo->class_id) {
                        array_push($errors, 'Lớp của SV ' . $student->id . " không đúng.");
                    }
                }
                
                if ($student->email && !filter_var($student->email, FILTER_VALIDATE_EMAIL)) {
                    array_push($errors, "Email của SV " . $student->id . " không đúng.");
                }
                
                if ($student->number_phone && !ctype_digit($student->number_phone)) {
                    array_push($errors, "SĐT của SV " . $student->id . " không đúng.");
                }
            }
            
            $this->data['studentList'] = $studentList;
            $this->data['errors'] = $errors;
            $this->data['class_names'] = $class_names;
            $this->data['science_names'] = $science_names;
            return view('student.addListStudent', $this->data);
        }
        return redirect()->route('student_get_add_list_route');
    }
    
    public function postSubmitStudentList(Request $request)
    {
        DB::beginTransaction();
        try {
            $id_arr = explode(',', $request->id);
            $name_arr = explode(',', $request->name);
            $gender_arr = explode(',', $request->gender);
            $birthday_arr = explode(',', $request->birthday);
            $hometown_arr = explode(',', $request->hometown);
            $email_arr = explode(',', $request->email);
            $number_phone_arr = explode(',', $request->number_phone);
            $class_arr = explode(',', $request->class_id);
            $science_arr = explode(',', $request->science_id);
            $cyu_arr = explode(',', $request->is_cyu);
            $partisan_arr = explode(',', $request->partisan_id);
            
            for ($i = 0; $i < count($id_arr); $i++) {
                $student = new Student;
                $student->id = $id_arr[$i];
                $student->name = $name_arr[$i];
                if ($gender_arr[$i] == 1) {
                    $student->is_female = 1;
                } else {
                    $student->is_female = 0;
                }
                if ($birthday_arr[$i] != "") {
                    $student->birthday = $birthday_arr[$i];
                }
                $student->hometown = $hometown_arr[$i];
                if ($email_arr[$i] != '') {
                    $student->email = $email_arr[$i];
                }
                if ($number_phone_arr[$i] != '') {
                    $student->number_phone = $number_phone_arr[$i];
                }
                $student->class_id = $class_arr[$i];
                $student->science_id = $science_arr[$i];
                $student->is_it_student = 1;
                $student->faculty_id = 1;
                $student->is_cyu = $cyu_arr[$i];
                $student->partisan_id = $partisan_arr[$i];
                
                $student->save();
            }
            
            Log::AddToLog('Import DS Sinh viên mới', '', $request->id);
            
            DB::commit();
            return redirect()->route('student_index_route');
        } catch (Exception $e) {
            DB::rollBack();
            $this->data['error'] = $e->getMessage();
            $this->data['result'] = false;
            return $this->data;
            
        }
    }
    
    public function getAddStatusList()
    {
        return view('student.import_update_student');
    }
    
    public function postAddStatusList(Request $request)
    {
        //Read Excell
        if ($request->hasFile('import')) {
            $result = Excel::load($request->import, function ($reader) {
            })->get()->toArray();
            $studentList = [];
            
            foreach ($result as $student) {
                $student = array_values($student);
                $studentStatusList = [];
                $newStudent["id"] = $student[0];
                $newStudent["status"] = $student[1];
                
                array_push($studentList, $newStudent);
            }
            // $this->data['studentList'] = $studentList;
            
            $errors = [];
            $names = [];
            //Check error
            foreach ($studentList as $student) {
                //check tồn tại sinh viên
                $check = Student::select(['name', 'class_id'])->find($student["id"]);
                if (is_null($check)) {
                    array_push($errors, "MSSV " . $student["id"] . " không tồn tại.");
                    array_push($names, null);
                } else {
                    array_push($names, $check->name);
                    if ($this->user->level == 3 && $this->userInfo->class_id != $check->class_id) {
                        array_push($errors, 'Lớp của SV ' . $student["id"] . " không đúng.");
                    }
                }
                
                if ($student["status"] <= 0 || $student["status"] > 4) {
                    array_push($errors, "Mã tình trạng của SV " . $student["id"] . " không đúng.");
                }
            }
            
            $this->data['studentList'] = $studentList;
            $this->data['errors'] = $errors;
            $this->data['names'] = $names;
            
            return view('student.import_update_student', $this->data);
        }
        return redirect()->route('student_get_add_status_list_route');
    }
    
    public function postSubmitStatusStudentList(Request $request)
    {
        DB::beginTransaction();
        try {
            $id_arr = explode(',', $request->id);
            $status_arr = explode(',', $request->status);
            
            $old_data = '';
            $new_data = '';
            
            for ($i = 0; $i < count($id_arr); $i++) {
                $student = Student::find($id_arr[$i]);
                
                $old_data .= 'SV: '.$student->id.' - TT: '.$student->status.'<br/>';
                
                $student->status = $status_arr[$i];
                
                $student->save();
                
                $new_data .= 'SV: '.$student->id.' - TT: '.$student->status.'<br/>';
            }
            
            
            Log::AddToLog('Import Update Student Status', $old_data, $new_data);
            DB::commit();
            return redirect()->route('student_index_route');
        } catch (Exception $e) {
            DB::rollBack();
            $this->data['error'] = $e->getMessage();
            $this->data['result'] = false;
            return $this->data;
        }
    }
    
    public function getExportList()
    {
        if ($this->user->level != 3) {
            $this->data['science_list'] = Science::orderBy('name', 'desc')->get();
            $this->data['class_list'] = Classes::orderBy('name', 'desc')->get();
            $this->data['faculty_list'] = Faculty::orderBy('id', 'asc')->get();
            
            return view('student.exportStudentList', $this->data);
        } else {
            return view('student.exportStudentList');
        }
    }
    
    public function postGetExportList(Request $request)
    {
        if ($this->user->level != 3) {
            $science_check = -1;
            $faculty_check = -1;
            $class_check = -1;
            
            if (!in_array(-1, $request->science_id)) {
                $sciencd_check = 0;
            }
            
            if (!in_array(-1, $request->faculty_id)) {
                if (!in_array(0, $request->faculty_id) || !in_array(1, $request->faculty_id)) {
                    $faculty_check = 0;
                }
            }
            
            if (!in_array(-1, $request->class_id)) {
                if (!in_array(1, $request->faculty_id)) {
                    $class_check = 0;
                } else {
                    $class_check = 1;
                }
            }
            
            $studentList = Student::orderBy('id', 'desc');
            if ($science_check == 0) {
                $studentList = $studentList->whereIn('science_id', $request->science_id);
            }
            if ($faculty_check == 0) {
                $studentList = $studentList->whereIn('faculty_id', $request->faculty_id);
            }
            if ($class_check == 1) {
                $studentList = $studentList->whereNull('class_id')->orWhere(function ($query) use ($request) {
                    $query->whereIn('class_id', $request->class_id);
                });
            }
            
            if ($request->cyu_id == 1) {
                $studentList = $studentList->where('is_cyu', 1);
            }
            if ($request->cyu_id == 0) {
                $studentList = $studentList->where('is_cyu', 0);
            }
            
            if ($request->pre_partisan_id == 1) {
                if ($request->partisan_id == 1) {
                    $studentList = $studentList->whereIn('partisan_id', [1, 2]);
                } else {
                    $studentList = $studentList->where('partisan_id', 1);
                }
            } elseif ($request->pre_partisan_id == 0) {
                if ($request->partisan_id == 1) {
                    $studentList = $studentList->where('partisan_id', 2);
                } elseif ($request->partisan_id == 0) {
                    $studentList = $studentList->where('partisan_id', 0);
                } else {
                    $studentList = $studentList->whereIn('partisan_id', [0, 2]);
                }
            } else {
                if ($request->partisan_id == 0) {
                    $studentList = $studentList->whereIn('partisan_id', [0, 1]);
                }
                if ($request->partisan_id == 1) {
                    $studentList = $studentList->where('partisan_id', 2);
                }
            }
            
            $studentList = $studentList->with('Science', 'Faculty', 'ClassOb')->get();
            $this->data['studentList'] = $studentList;
            $this->data['science_chosen_list'] = $request->science_id;
            $this->data['faculty_chosen_list'] = $request->faculty_id;
            $this->data['class_chosen_list'] = $request->class_id;
            $this->data['partisan_id'] = $request->partisan_id;
            $this->data['pre_partisan_id'] = $request->pre_partisan_id;
            $this->data['cyu_id'] = $request->cyu_id;
            
            $this->data['science_list'] = Science::orderBy('name', 'desc')->get();
            $this->data['class_list'] = Classes::orderBy('name', 'desc')->get();
            $this->data['faculty_list'] = Faculty::orderBy('id', 'asc')->get();
        } else {
            $studentList = Student::with('Science', 'Faculty', 'ClassOb')->where('class_id', $this->userInfo->class_id)->orderBy('id', 'desc')->get();
            $this->data['studentList'] = $studentList;
        }
        
        if ($request->submit_btn == "Preview") {
            return view('student.exportStudentList', $this->data);
        }
        
        if ($request->submit_btn == "Download") {
            Excel::create('Danh_Sach_SV', function ($excel) use ($studentList) {
                $excel->sheet('DSSV', function ($sheet) use ($studentList) {
                    $sheet->row(1, array(
                        'MSSV', 'Họ tên', 'Giới tính', 'Năm sinh', 'Quê quán', 'Khóa', 'Lớp', 'Đoàn viên', 'Đảng viên', 'Email', 'SĐT', 'Tình trạng',
                    ));
                    foreach ($studentList as $student) {
                        $row_data = array();
                        
                        array_push($row_data, $student->id);
                        array_push($row_data, $student->name);
                        if ($student->is_female) {
                            array_push($row_data, 'Nữ');
                        } else {
                            array_push($row_data, 'Nam');
                        }
                        if ($student->birthday != null && $student->birthday != '') {
                            array_push($row_data, date('d/m/Y', strtotime($student->birthday)));
                        } else {
                            array_push($row_data, '');
                        }
                        if ($student->hometown != null) {
                            array_push($row_data, $student->hometown);
                        } else {
                            array_push($row_data, '');
                        }
                        if ($student->Science != null) {
                            array_push($row_data, $student->Science->name);
                        } else {
                            array_push($row_data, '');
                        }
                        if ($student->ClassOb != null) {
                            array_push($row_data, $student->ClassOb->name);
                        } else {
                            array_push($row_data, '');
                        }
                        if ($student->is_cyu == 1) {
                            array_push($row_data, 'x');
                        } else {
                            array_push($row_data, '');
                        }
                        if ($student->partisan_id == 1) {
                            array_push($row_data, 'CTĐ');
                        } elseif ($student->partisan_id == 2) {
                            array_push($row_data, 'ĐV');
                        } else {
                            array_push($row_data, '');
                        }
                        if ($student->email != null) {
                            array_push($row_data, $student->email);
                        } else {
                            array_push($row_data, '');
                        }
                        if ($student->number_phone != null) {
                            array_push($row_data, $student->number_phone);
                        } else {
                            array_push($row_data, '');
                        }
                        if ($student->status == 2) {
                            array_push($row_data, 'TN');
                        } elseif ($student->status == 3) {
                            array_push($row_data, 'BL');
                        } elseif ($student->status == 4) {
                            array_push($row_data, 'ĐH');
                        } else {
                            array_push($row_data, '');
                        }
                        
                        $sheet->appendRow($row_data);
                    }
                    
                    $sheet->setFontSize(13);
                    $sheet->setFontFamily('Times New Roman');
                    $sheet->row(1, function ($row) {
                        $row->setFontWeight('bold');
                    });
                });
            })->export('xlsx');
            
            return redirect()->route('student_get_export_list_route');
        }
    }
    
    public function updatePartisan()
    {
        return view('student.import_update_book_partisan');
    }
    
    public function postUpdatePartisan(Request $request)
    {
        //Read Excell
        if ($request->hasFile('import')) {
            $result = Excel::load($request->import, function ($reader) {
            })->get()->toArray();
            $studentList = [];
            foreach ($result as $student) {
                $student = array_values($student);
                $studentStatusList = [];
                if ($student[0] != null) {
                    $newStudent["id"] = $student[0];
                    $newStudent["name"] = $student[1];
                    $newStudent["workplace_union_old"] = $student[2];
                    $newStudent["date_on_union"] = Carbon::createFromFormat('d/m/Y', $student[3])->format('Y-m-d');;
                    $newStudent["date_get_union"] = Carbon::createFromFormat('d/m/Y', $student[4])->format('Y-m-d');;
                    array_push($studentList, $newStudent);
                }
            }
            
            $errors = [];
            $names = [];
            //Check error
            foreach ($studentList as $student) {
                //check tồn tại sinh viên
                $check = Student::select(['name', 'class_id'])->find($student["id"]);
                if (is_null($check)) {
                    array_push($errors, "MSSV " . $student["id"] . " không tồn tại.");
                    array_push($names, null);
                } else {
                    array_push($names, $check->name);
                    if ($this->user->level == 3 && $this->userInfo->class_id != $check->class_id) {
                        array_push($errors, 'Lớp của SV ' . $student["id"] . " không đúng.");
                    }
                }
            }
            
            $this->data['studentList'] = $studentList;
            $this->data['errors'] = $errors;
            $this->data['names'] = $names;
            // dd($this->data);
            return view('student.import_update_book_partisan', $this->data);
        }
        return redirect()->route('student_get_update_partisan');
    }
    
    public function postSubmitUpdatePartisan(Request $request)
    {
        DB::beginTransaction();
        try {
            $id_arr = $request->id;
            $workplace_union_old = $request->workplace_union_old;
            $date_on_union = $request->date_on_union;
            $date_get_union = $request->date_get_union;
            
            $old_data = '';
            $new_data = '';
            
            for ($i = 0; $i < count($request->id); $i++) {
                $student = Student::find($id_arr[$i]);
                $old_data .= $student->id;
                $new_data .= $student->id;
                
                if($student->workplace_union_old != $workplace_union_old[$i]) {
                    $old_data .= ' - Nơi SH cũ: '.$student->workplace_union_old;
                    $new_data .= ' - Nơi SH cũ: '.$workplace_union_old[$i];

                    $student->workplace_union_old = $workplace_union_old[$i];
                }
                if($student->date_on_union != $date_on_union[$i]) {
                    $old_data .= ' - Ngày vào Đoàn: '.$student->date_on_union;
                    $new_data .= ' - Ngày vào Đoàn: '.$date_on_union[$i];

                    $student->date_on_union = $date_on_union[$i];
                }
                if($student->date_get_union != $date_get_union[$i]) {
                    $old_data .= ' - Ngày rút sổ  Đoàn: '.$student->date_get_union;
                    $new_data .= ' - Ngày rút sổ  Đoàn: '.$date_get_union[$i];

                    $student->date_get_union = $date_get_union[$i];
                }

                $student->is_cyu = 1;

                $old_data .= '<br/>';
                $new_data .= '<br/>';
                
                $student->save();
            }

            Log::AddToLog('Import DS TT Đoàn viên', $old_data, $new_data);
            
            DB::commit();
            return redirect()->route('student_index_route');
        } catch (Exception $e) {
            DB::rollBack();
            $this->data['error'] = $e->getMessage();
            $this->data['result'] = false;
            return $this->data;
        }
    }
}
