<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Http\Requests\AddClassRequest;
use App\Http\Requests\EditClassRequest;
use App\Models\Science;
use Illuminate\Http\Request;

class ClassesController extends Controller {
    public function getClassList() {
        $this->data['classList'] = Classes::orderBy('name', 'desc')->get();
        $this->data['scienceList'] = Science::orderBy('name', 'desc')->get();

        return view('class.classList', $this->data);
    }

    public function postAddClass(AddClassRequest $request) {
        $className = $request->txtAddClassName;
        $scienceId = $request->slAddClassScienceId;

        $classOb = new Classes;
        $classOb->name = $className;
        $classOb->science_id = $scienceId;

        $classOb->save();

        return redirect('/lop-hoc')->with(['success_alert' => 'Thêm Lớp Học Thành Công']);
    }

    public function getClassListByScienceId($scienceId)
    {
        if($scienceId != 0) {
            $classList = Classes::with('Science')->where('science_id', $scienceId)->orderBy('id', 'desc')->get();
        }
        else{
            $classList = Classes::with('Science')->orderBy('id', 'desc')->get();
        }
        return response()->json(['classList'=>$classList]);
    }

    public function postEditClass(EditClassRequest $request, $id) {
        $classOb = Classes::find($id);

        $classOb->name = $request->txtEditClassName;
        $classOb->science_id = $request->slEditClassScienceId;

        $classOb->save();

        return redirect('/lop-hoc')->with(['success_alert' => 'Cập nhật Lớp học thành công!']);
    }

    public function postDeleteClass(Request $request) {
        $classOb = Classes::find($request->id);
        $classOb->delete();

        $this->data['classList'] = Classes::orderBy('id', 'desc')->get();

        return response()->view('class.classListTable', $this->data);
    }

    public function ajaxGetClassInfo($class_id) {
        $this->data['classOb'] = Classes::find($class_id);
        $this->data['scienceList'] = Science::orderBy('id', 'desc')->get();

        return response()->view('class.getClassInfo', $this->data);
    }
}
