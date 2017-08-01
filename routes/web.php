<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('student')->group(function() {
    Route::get('/', function() {
        return view('student.studentList');
    })->name('student_index_route');

    Route::get('add', function() {
        return view('student.addStudent');
    })->name('student_add_route');

    Route::get('add-list', function() {
        return view('student.addListStudent');
    })->name('student_add_list_route');
});

Route::prefix('science')->group(function() {
    Route::get('/', function() {
        return view('science.scienceList');
    })->name('science_index_route');
});

Route::prefix('school-year')->group(function() {
    Route::get('/', function() {
        return view('school_year.schoolYearList');
    })->name('school_year_index_route');
});
