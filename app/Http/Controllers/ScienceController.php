<?php

namespace App\Http\Controllers;

use App\Science;
use Illuminate\Http\Request;

class ScienceController extends Controller
{
    public function getAllList() {
        $scienceList = Science::all();

        return view('science.scienceList', ['scienceList' => $scienceList]);
    }

    public function getAddScience() {
        $topScience = Science::orderBy('id', 'desc')->take(1)->first();

        $maxScienceId = substr($topScience->id, -2);

        $newScienceId = 'KH'.($maxScienceId + 1);
        $newScienceName = '20'.($maxScienceId + 1);

        $science = new Science();
        $science->id = $newScienceId;
        $science->nameScience = $newScienceName;

        $science->save();

        return response()->json(['response' => true]);
    }
}
