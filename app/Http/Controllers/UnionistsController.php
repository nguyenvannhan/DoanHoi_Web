<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Student;
use Auth;
use DB;
use Excel;
use Exception;
use Illuminate\Http\Request;
use \Carbon\Carbon;

class UnionistsController extends Controller
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

    public function getUnionistList()
    {
        if ($this->user->level != 3) {
            $this->data['unionistList'] = Student::where('is_it_student', 1)->where('is_cyu', 1)->orderBy('id', 'desc')->with('ClassOb')->get();
            $this->data['nonUnionistList'] = Student::where('is_it_student', 1)->where('is_cyu', 0)->orderBy('id', 'desc')->with('ClassOb')->get();
            $this->data['classList'] = Classes::orderBy('name', 'desc')->take(30)->get();
        } else {
            $this->data['unionistList'] = Student::where('is_it_student', 1)->where('is_cyu', 1)->where('class_id', $this->userInfo->class_id)->orderBy('id', 'desc')->with('ClassOb')->get();
            $this->data['nonUnionistList'] = Student::where('is_it_student', 1)->where('is_cyu', 0)->where('class_id', $this->userInfo->class_id)->orderBy('id', 'desc')->with('ClassOb')->get();
        }

        return view('union.unionist-list', $this->data);
    }

    public function getPartisanList()
    {
        if ($this->user->level != 3) {
            $this->data['partisanList'] = Student::where('is_it_student', 1)->where('partisan_id', 2)->orderBy('id', 'desc')->get();
            $this->data['prePartisanList'] = Student::where('is_it_student', 1)->where('partisan_id', 1)->orderBy('id', 'desc')->get();
        } else {
            $this->data['partisanList'] = Student::where('is_it_student', 1)->where('partisan_id', 2)->where('class_id', $this->userInfo->class_id)->orderBy('id', 'desc')->get();
            $this->data['prePartisanList'] = Student::where('is_it_student', 1)->where('partisan_id', 1)->where('class_id', $this->userInfo->class_id)->orderBy('id', 'desc')->get();
        }

        return view('union.partisan-list', $this->data);
    }

    public function getUnionBook() {
        return view('union.union-book');
    }

    public function getInfoBook($id) {
        $this->data['student'] = Student::find($id);

        return response()->view('union.update-book-info', $this->data);
    }

    public function postInfoBook(Request $request) {
        $student = Student::find($request->id);

        if(!is_null($student)) {
            $student->workplace_union_old = $request->workplace_union_old;
            $student->workplace_union_new = $request->workplace_union_new;
            if ($request->date_set_union != null) {
                $student->date_set_union = Carbon::createFromFormat('d/m/Y', $request->date_set_union)->format('Y-m-d');
            } else {
                $student->date_set_union = null;
            }
            $student->place_on_union = $request->place_on_union;
            if ($request->date_on_union != null) {
                $student->date_on_union = Carbon::createFromFormat('d/m/Y', $request->date_on_union)->format('Y-m-d');
            } else {
                $student->date_on_union = null;
            }
            if ($request->date_get_union != null) {
                $student->date_get_union = Carbon::createFromFormat('d/m/Y', $request->date_get_union)->format('Y-m-d');
            } else {
                $student->date_get_union = null;
            }


            $student->save();
            return "true";
        }

        return "false";
    }

    public function postUpdateUnionist(Request $request)
    {
        $id = $request->id;

        $student = Student::find($id);
        if ($request->type_id == 1) {
            $student->is_cyu = 1;
        } else {
            $student->is_cyu = 0;
        }
        $student->save();

        $class_id_list = $request->class_id;
        if (in_array(0, $class_id_list)) {
            $unionistList = Student::where('is_it_student', 1)->where('is_cyu', 1)->orderBy('id', 'desc')->with('ClassOb')->get();
            $nonUnionistList = Student::where('is_it_student', 1)->where('is_cyu', 0)->orderBy('id', 'desc')->with('ClassOb')->get();
        } else {
            $unionistList = Student::where('is_it_student', 1)->where('is_cyu', 1)->whereIn('class_id', $class_id_list)->orderBy('id', 'desc')->with('ClassOb')->get();
            $nonUnionistList = Student::where('is_it_student', 1)->where('is_cyu', 0)->whereIn('class_id', $class_id_list)->orderBy('id', 'desc')->with('ClassOb')->get();
        }

        $this->data['unionistView'] = view('union.unionist-table', ['items' => $unionistList, 'type_id' => 1])->render();
        $this->data['nonUnionistView'] = view('union.unionist-table', ['items' => $nonUnionistList, 'type_id' => 0])->render();

        return response()->json($this->data);
    }

    public function getImportFileCYU()
    {
        return view('union.import-file');
    }

    public function postImportFileCYU(Request $request)
    {
        //Read Excell
        if ($request->hasFile('import')) {
            $result = Excel::load($request->import, function ($reader) {
            })->get()->toArray();
            $unionistList = [];
            $errors = [];

            foreach ($result as $unionist) {
                $unionist = array_values($unionist);

                $newUnionist = new Student();
                $newUnionist->id = $unionist[0];
                if ($unionist[1] != '') {
                    $newUnionist->is_cyu = 1;
                } else {
                    $newUnionist->is_cyu = 0;
                }

                $checkST = Student::find($unionist[0]);
                if (is_null($checkST)) {
                    array_push($errors, 'MSSV ' . $unionist[0] . ' không tồn tại!');
                } else {
                    if ($this->user->level == 3 && $checkST->class_id != $this->userInfo->class_id) {
                        array_push($errors, 'MSSV ' . $unionist[0] . ' không thuộc lớp bạn!');
                    }
                    $newUnionist->name = $checkST->name;
                    $newUnionist->class_id = $checkST->ClassOb->name;
                }

                array_push($unionistList, $newUnionist);
            }

            $this->data['unionistList'] = $unionistList;
            $this->data['errors'] = $errors;

            return view('union.import-file', $this->data);
        }
        return view('union.import-file');
    }

    public function postSubmitImportFileCYU(Request $request)
    {
        DB::beginTransaction();
        try {
            $id_arr = $request->id;
            $is_cyu_arr = $request->is_cyu;

            for ($i = 0; $i < count($id_arr); $i++) {
                $student = Student::find($id_arr[$i]);

                if ($is_cyu_arr[$i] == 1) {
                    $student->is_cyu = 1;
                } else {
                    $student->is_cyu = 0;
                }

                $student->save();
            }

            DB::commit();
            return redirect()->route('get_unioinist_list');
        } catch (Exception $e) {
            DB::rollBack();
        }
    }

    public function getAjaxUnionitList(Request $request)
    {
        $class_id_list = $request->class_id;

        if (in_array(0, $class_id_list)) {
            $unionistList = Student::where('is_it_student', 1)->where('is_cyu', 1)->orderBy('id', 'desc')->with('ClassOb')->get();
            $nonUnionistList = Student::where('is_it_student', 1)->where('is_cyu', 0)->orderBy('id', 'desc')->with('ClassOb')->get();
        } else {
            $unionistList = Student::where('is_it_student', 1)->where('is_cyu', 1)->whereIn('class_id', $class_id_list)->orderBy('id', 'desc')->with('ClassOb')->get();
            $nonUnionistList = Student::where('is_it_student', 1)->where('is_cyu', 0)->whereIn('class_id', $class_id_list)->orderBy('id', 'desc')->with('ClassOb')->get();
        }

        $this->data['unionistView'] = view('union.unionist-table', ['items' => $unionistList, 'type_id' => 1])->render();
        $this->data['nonUnionistView'] = view('union.unionist-table', ['items' => $nonUnionistList, 'type_id' => 0])->render();

        return response()->json($this->data);
    }

    public function postAddPartisan(Request $request)
    {
        $student = Student::find($request->id);
        $u_errors = [];

        if (!is_null($student)) {
            $student->partisan_id = $request->partisan_id;

            if ($student->email != $request->email) {
                $student->email = $request->email;
            }

            if ($student->number_phone != $request->numberphone) {
                $student->number_phone = $request->numberphone;
            }

            if ($student->partisan_id != 1 && $student->partisan_id != 2) {
                array_push($u_errors, 'Sinh viên đã có trong NTK rồi!');
            } else {
                $student->save();
            }
        } else {
            array_push($u_errors, 'Sinh viên không tồn tại!');
        }

        $this->data['u_errors'] = $u_errors;
        $this->data['partisanList'] = Student::where('is_it_student', 1)->where('partisan_id', 2)->orderBy('id', 'desc')->get();
        $this->data['prePartisanList'] = Student::where('is_it_student', 1)->where('partisan_id', 1)->orderBy('id', 'desc')->get();

        return view('union.partisan-list', $this->data);
    }

    public function postAjaxDeletePartisan(Request $request)
    {
        $student = Student::find($request->id);
        if (!is_null($student)) {
            $student->partisan_id = 0;
            $student->save();

            return response()->json(['result' => true]);
        } else {
            return response()->json(['result' => false]);
        }
    }

    public function postAjaxExportUnionist(Request $request)
    {
        $idClassList = $request->class_id_arr;

        $type_id = $request->type_id;
        if ($this->user->level == 3) {
            $checkAll = 1;
        } else {
            if (in_array(0, $idClassList)) {
                $checkAll = 1;
            } else {
                $checkAll = 0;
            }
        }

        if ($type_id == 1) {
            $title = 'DANH SÁCH ĐOÀN VIÊN';
            $file_name = 'DS_Doan_Vien';
            $studentList = Student::where('is_it_student', 1)->where('is_cyu', 1);
            if ($checkAll) {
                $studentList = $studentList->with('ClassOb', 'Science')->orderBy('id', 'desc');
            } else {
                $studentList = $studentList->whereIn('class_id', $idClassList)->with('ClassOb', 'Science')->orderBy('id', 'desc');
            }
        } else {
            $title = 'DANH SÁCH CHƯA KẾT NẠP ĐOÀN VIÊN';
            $file_name = 'DS_Chua_Doan_Vien';
            $studentList = Student::where('is_it_student', 1)->where('is_cyu', 0);
            if ($checkAll) {
                $studentList = $studentList->with('ClassOb', 'Science')->orderBy('id', 'desc');
            } else {
                $studentList = $studentList->whereIn('class_id', $idClassList)->with('ClassOb', 'Science')->orderBy('id', 'desc');
            }
        }

        if ($this->user->level == 3) {
            $studentList = $studentList->where('class_id', $this->userInfo->class_id);
        }

        $studentList = $studentList->get();
        $excelFile = Excel::create($file_name, function ($excel) use ($studentList, $file_name, $title) {
            $excel->sheet($file_name, function ($sheet) use ($studentList, $title) {
                $sheet->row(1, array($title));
                $sheet->row(2, array(
                    'MSSV', 'Họ tên', 'Giới tính', 'Năm sinh', 'Quê quán', 'Khóa', 'Lớp', 'Email', 'SĐT', 'Tình trạng',
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

                $sheet->mergeCells('A1:J1');
                $sheet->setFontSize(13);
                $sheet->setFontFamily('Times New Roman');
                $sheet->row(1, function ($row) {
                    $row->setFontWeight('bold');
                });
            });
        })->string('xlsx');

        $response = array(
            'name' => $file_name . '.xlsx', //no extention needed
            'file' => "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64," . base64_encode($excelFile), //mime type of used format
        );
        return response()->json($response);
    }

    public function postAjaxExportPartisan(Request $request)
    {
        $partisanList = Student::where('is_it_student', 1)->where('partisan_id', 2)->get();

        $prePartisanList = Student::where('is_it_student', 1)->where('partisan_id', 1)->get();

        $file_name = 'DS_DangVien_CamTinhDang';

        $excelFile = Excel::create($file_name, function ($excel) use ($partisanList, $prePartisanList) {
            $excel->sheet('Đảng viên', function ($sheet1) use ($partisanList) {
                $sheet1->row(1, array(
                    'MSSV', 'Họ tên', 'Giới tính', 'Năm sinh', 'Quê quán', 'Email', 'SĐT', 'Tình trạng',
                ));

                foreach ($partisanList as $student) {
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

                    $sheet1->appendRow($row_data);
                }

                $sheet1->setFontSize(13);
                $sheet1->setFontFamily('Times New Roman');
                $sheet1->row(1, function ($row) {
                    $row->setFontWeight('bold');
                });
            });

            $excel->sheet('Cảm tình Đảng', function ($sheet2) use ($prePartisanList) {
                $sheet2->row(1, array(
                    'MSSV', 'Họ tên', 'Giới tính', 'Năm sinh', 'Quê quán', 'Email', 'SĐT', 'Tình trạng',
                ));

                foreach ($prePartisanList as $student) {
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

                    $sheet2->appendRow($row_data);
                }

                $sheet2->setFontSize(13);
                $sheet2->setFontFamily('Times New Roman');
                $sheet2->row(1, function ($row) {
                    $row->setFontWeight('bold');
                });
            });
        })->string('xlsx');

        $response = array(
            'name' => $file_name . '.xlsx', //no extention needed
            'file' => "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64," . base64_encode($excelFile), //mime type of used format
        );
        return response()->json($response);
    }
}
