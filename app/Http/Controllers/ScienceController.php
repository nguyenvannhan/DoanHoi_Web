<?php

namespace App\Http\Controllers;

use App\Science;
use Illuminate\Http\Request;

class ScienceController extends Controller
{
    public function getAllList() {
        $scienceList = Science::all();

        foreach($scienceList as $science) {
            var_dump($science->id);
        }

        return view('science.scienceList', ['scienceList' => $scienceList]);
    }
}
