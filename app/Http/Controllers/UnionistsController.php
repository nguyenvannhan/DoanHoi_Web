<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Classes;

class UnionistsController extends Controller {
    public function getUnionistList() {
        $this->data['unionistList'] = Student::where('is_it_student')->where('is_cyu', 1)->orderBy('id', 'desc')->with('ClassOb')->get();
        $this->data['nonUnionistList'] = Student::where('is_it_student')->where('is_cyu', 0)->orderBy('id', 'desc')->with('ClassOb')->get();
        $this->data['classList'] = Classes::orderBy('name', 'desc')->take(30)->get();

        return view('union.unionist-list', $this->data);
    }
}
