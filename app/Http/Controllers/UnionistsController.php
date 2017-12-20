<?php

namespace App\Http\Controllers;

use Excel;
use DB;
use Exception;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Classes;

class UnionistsController extends Controller {
    public function getUnionistList() {
        $this->data['unionistList'] = Student::where('is_it_student', 1)->where('is_cyu', 1)->orderBy('id', 'desc')->with('ClassOb')->get();
        $this->data['nonUnionistList'] = Student::where('is_it_student', 1)->where('is_cyu', 0)->orderBy('id', 'desc')->with('ClassOb')->get();
        $this->data['classList'] = Classes::orderBy('name', 'desc')->take(30)->get();

        return view('union.unionist-list', $this->data);
    }

    public function getPartisanList() {
        $this->data['partisanList'] = Student::where('is_it_student', 1)->where('partisan_id', 2)->orderBy('id', 'desc')->get();
        $this->data['prePartisanList'] = Student::where('is_it_student', 1)->where('partisan_id', 1)->orderBy('id', 'desc')->get();

        return view('union.partisan-list', $this->data);
    }

    public function postUpdateUnionist(Request $request) {
        $id = $request->id;

        $student = Student::find($id);
        if($request->type_id == 1) {
            $student->is_cyu = 1;
        } else {
            $student->is_cyu = 0;
        }
        $student->save();

        $class_id_list = $request->class_id;
        if(in_array(0, $class_id_list)) {
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

    public function getImportFileCYU() {
        return view('union.import-file');
    }

    public function postImportFileCYU(Request $request) {
        //Read Excell
        if($request->hasFile('import')) {
            $result = Excel::load($request->import, function($reader) {
            })->get()->toArray();
            $unionistList = [];
            $errors = [];

            foreach($result as $unionist) {
                $unionist = array_values($unionist);

                $newUnionist = new Student();
                $newUnionist->id = $unionist[0];
                if($unionist[1] != '') {
                    $newUnionist->is_cyu = 1;
                } else {
                    $newUnionist->is_cyu = 0;
                }

                $checkST = Student::find($unionist[0]);
                if(is_null($checkST)) {
                    array_push($errors, 'MSSV '.$unionist[0].' không tồn tại!');
                } else {
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

    public function postSubmitImportFileCYU(Request $request) {
        DB::beginTransaction();
        try {
            $id_arr = $request->id;
            $is_cyu_arr = $request->is_cyu;

            for($i = 0; $i < count($id_arr); $i++) {
                $student = Student::find($id_arr[$i]);

                if($is_cyu_arr[$i] == 1) {
                    $student->is_cyu = 1;
                } else {
                    $student->is_cyu = 0;
                }

                $student->save();
            }

            DB::commit();
            return redirect()->route('get_unioinist_list');
        } catch(Exception $e) {
            DB::rollBack();
        }
    }

    public function getAjaxUnionitList(Request $request) {
        $class_id_list = $request->class_id;

        if(in_array(0, $class_id_list)) {
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

    public function postAddPartisan(Request $request) {
        $student = Student::find($request->id);
        $u_errors = [];

        if(!is_null($student)) {
            $student->partisan_id = $request->partisan_id;

            if($student->email != $request->email) {
                $student->email = $request->email;
            }

            if($student->number_phone != $request->numberphone) {
                $student->number_phone = $request->numberphone;
            }

            if($student->partisan_id != 1 && $student->partisan_id != 2) {
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

    public function postAjaxDeletePartisan(Request $request) {
        $student = Student::find($request->id);
        return $student;
        if(!is_null($student)) {
            $student->partisan_id = 0;
            $student->save();

            return response()->json(['result' => true]);
        } else {
            return response()->json(['result' => false]);
        }
    }
}
