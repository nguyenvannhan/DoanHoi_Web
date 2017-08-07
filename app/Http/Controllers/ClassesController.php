<?php

namespace App\Http\Controllers;

use App\Classes;
use App\Http\Requests\AddClassRequest;
use App\Http\Requests\EditClassRequest;
use App\Science;
use Illuminate\Http\Request;

class ClassesController extends Controller {
    public function getClassList() {
        $classList = Classes::with('Science')->orderBy('id', 'desc')->get();
        $scienceList = Science::orderBy('id', 'desc')->get();

        return view('class.classList', ['classList' => $classList, 'scienceList' => $scienceList]);
    }

    public function postAddClass(AddClassRequest $request) {
        $className = $request->txtAddClassName;
        $scienceId = $request->slAddScienceId;

        $classOb = new Classes;
        $classOb->nameClass = $className;
        $classOb->scienceId = $scienceId;

        $classOb->save();

        return redirect('/class')->with(['success_alert' => 'Thêm Lớp Học Thành Công']);
    }

    public function getEditClass($id) {
        $classOb = Classes::find($id);

        return response()->json(['classOb' => $classOb]);
    }

    public function postEditClass(EditClassRequest $request, $id) {
        $classOb = Classes::find($id);

        $classOb->nameClass = $request->txtEditClassName;
        $classOb->scienceId = $request->slEditScienceId;

        $classOb->save();

        return redirect('/class')->with(['success_alert' => 'Cập nhật Lớp học thành công!']);
    }
}
