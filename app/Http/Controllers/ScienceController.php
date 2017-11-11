<?php

namespace App\Http\Controllers;

use App\Models\Science;
use Illuminate\Http\Request;

class ScienceController extends Controller
{
    public function getAllList() {
        $this->data['scienceList'] = Science::orderBy('id', 'desc')->get();

        return view('science.scienceList', $this->data);
    }

    public function getAddScience() {
        $topScience = Science::orderBy('id', 'desc')->take(1)->first();

        $newScienceName = date('Y');

        if(!is_null($topScience)) {
            $maxScienceId = substr($topScience->nameScience, -2);
            $newScienceName = '20'.($maxScienceId + 1);
        }

        $science = new Science();
        $science->nameScience = $newScienceName;

        $science->save();

        return redirect('/science')->with(['success_alert' => 'Thêm Khóa học thành công!']);
    }
    public function getEditScience($id) {
        $scienceOb = Science::find($id);

        return response()->json(['scienceOb' => $scienceOb]);
    }
    public function posttAddScience(Request $request){
        $khoahoc= $request->txtKhoaHoc;
        $khoahocob = new Science;
        $khoahocob->nameScience = $khoahoc;
        $khoahocob->save();
        return redirect('/science')->with(['success_alert' => 'Thêm Khóa Học Thành Công']);
    }

    public function postAjaxAddScience() {
        $topScience = Science::orderBy('id', 'desc')->take(1)->first();

        $newScienceName = '';

        if($topScience) {
            $maxScienceId = substr($topScience->name, -2);
            $newScienceName = '20'.($maxScienceId + 1);
        } else {
            $newScienceName = date('Y');;
        }


        $science = new Science();
        $science->name = $newScienceName;

        $science->save();

        $this->data['scienceList'] = Science::orderBy('id', 'desc')->get();
        return response()->view('science.ajaxScienceListTable', $this->data);
    }
}
