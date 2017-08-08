<?php

namespace App\Http\Controllers;

use App\Classes;
use App\Science;
use App\Studentes;
use Illuminate\Http\Request;

class StudentesController extends Controller
{
    public function getStudentList() {
        $studentList = Studentes::with('Classes')->orderBy('mssv', 'desc')->get();
        $classList = Classes::orderBy('id', 'desc')->get();

        return view('student.studentList', ['classList' => $classList, 'studentList' => $studentList]);
    }
    public function getInfoStudent($mssv){
    	$studentOb = Studentes::find($mssv);

        return response()->json(['studentOb' => $studentOb]);
    }
}
