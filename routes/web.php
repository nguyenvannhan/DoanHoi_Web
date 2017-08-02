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
Route::prefix('class')->group(function() {
    Route::get('/', function() {
        return view('class.classList');
    })->name('class_index_route');
    Route::get('add', function() {
        return view('class.addClass');
    })->name('class_add_route');
});
Route::prefix('activity')->group(function() {
    Route::get('/', function() {
        return view('activity.activityList');
    })->name('activity_index_route');
    Route::get('add', function() {
        return view('activity.addActivity');
    })->name('activity_add_route');
    Route::get('detail', function() {
        return view('activity.detailOneActivity');
    })->name('activity_detail_route');
});
Route::prefix('BCH-Khoa')->group(function() {
    Route::get('/', function() {
        return view('BCH_Khoa.BCH_KhoaList');
    })->name('BCH_Khoa_index_route');
    Route::get('add', function() {
        return view('BCH_Khoa.addBCH_Khoa');
    })->name('BCH_Khoa_add_route');
    Route::get('add-list', function() {
        return view('BCH_Khoa.addListBCH_Khoa');
    })->name('BCH_Khoa_add_list_route');
});
Route::prefix('BCH-Lop')->group(function() {
    Route::get('/', function() {
        return view('BCH_Lop.BCH_LopList');
    })->name('BCH_Lop_index_route');
    Route::get('add', function() {
        return view('BCH_Lop.addBCH_Lop');
    })->name('BCH_Lop_add_route');
    Route::get('add-list', function() {
        return view('BCH_Lop.addListBCH_Lop');
    })->name('BCH_Lop_add_list_route');
});
