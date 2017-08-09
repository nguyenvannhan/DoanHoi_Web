<?php

namespace App\Http\Controllers;

use App\Science;
use Illuminate\Http\Request;

class ScienceController extends Controller
{
    public function getAllList() {
        $scienceList = Science::orderBy('id', 'desc')->get();

        return view('science.scienceList', ['scienceList' => $scienceList]);
    }

    public function getAddScience() {
        $topScience = Science::orderBy('id', 'desc')->take(1)->first();

        $maxScienceId = substr($topScience->nameScience, -2);
        $newScienceName = '20'.($maxScienceId + 1);

        $science = new Science();
        $science->nameScience = $newScienceName;

        $science->save();

        return redirect('/science')->width(['success_alert' => 'Thêm Khóa học thành công!']);
    }

    public function getAjaxAddScience() {
        $topScience = Science::orderBy('id', 'desc')->take(1)->first();

        $maxScienceId = substr($topScience->nameScience, -2);
        $newScienceName = '20'.($maxScienceId + 1);

        $science = new Science();
        $science->nameScience = $newScienceName;

        $science->save();

        $scienceList = Science::orderBy('id', 'desc')->get();

        return response()->json(['scienceList' => $scienceList]);
    }
}
