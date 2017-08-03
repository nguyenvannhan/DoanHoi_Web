<?php

namespace App\Http\Controllers;

use App\Classes;
use App\Science;
use Illuminate\Http\Request;

class ClassesController extends Controller {
    public function getClassList() {
        $classList = Classes::with('Science')->orderBy('id', 'desc')->get();
        $scienceList = Science::orderBy('id', 'desc')->get();

        return view('class.classList', ['classList' => $classList, 'scienceList' => $scienceList]);
    }
}
