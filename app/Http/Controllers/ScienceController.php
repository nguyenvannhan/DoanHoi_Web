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

        return response()->json(['response' => true]);
    }
}
