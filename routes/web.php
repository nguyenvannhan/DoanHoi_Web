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
    Route::get('/', 'StudentesController@getStudentList')->name('student_index_route');
    Route::get('info/{mssv}', 'StudentesController@getInfoStudent')->name('get_info_student_route');
    Route::get('add','StudentesController@getAddStudentList')->name('student_add_route');
    Route::post('add','StudentesController@postAddStudent')->name('post_student_add_route');

    Route::get('add-list', function() {
        return view('student.addListStudent');
    })->name('student_add_list_route');
});

//Route science
Route::prefix('science')->group(function() {
    Route::get('/', 'ScienceController@getAllList')->name('science_index_route');
<<<<<<< HEAD
    Route::get('edit/{id}', 'ScienceController@getEditScience')->name('get_edit_science_route');
    Route::get('/add', 'ScienceController@getAddScience')->name('get_add_science');
    Route::post('add-new','ScienceController@posttAddScience')->name('science_add_route');
=======

    Route::get('add', 'ScienceController@getAddScience')->name('get_add_science');
>>>>>>> 979a1cfa4fcc42195509c1227cad834d6c158fd0
});

//Route chool year
Route::prefix('school-year')->group(function() {
    Route::get('/','School_YearesController@getAllList')->name('school_year_index_route');
    Route::get('add','School_YearesController@getAddSchool_Year')->name('get_school_year_add_route');
});

//Route class
Route::prefix('class')->group(function() {
    Route::get('/{scienceId?}', 'ClassesController@getClassList')->name('class_index_route');

    Route::get('{scienceId}', 'ClassesController@getClassListBySearch')->name('class_search_route');

    Route::post('add', 'ClassesController@postAddClass')->name('post_add_class_route');

    Route::get('edit/{id}', 'ClassesController@getEditClass')->name('get_edit_class_route');
    Route::post('edit/{id}', 'ClassesController@postEditClass')->name('post_edit_class_route');

    Route::get('delete/{id}', 'ClassesController@getDeleteClass')->name('get_delete_class_route');
});

//Route activities
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
    Route::get('add-list-student-activity', function() {
        return view('activity.addListStudentActivity');
    })->name('activity_list_student_route');
});

//Route faculty commitee
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

// Route class commitee
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


//Route ajax
Route::prefix('ajax')->group(function() {
    Route::get('add-science', 'ScienceController@getAjaxAddScience')->name('ajax_add_science_route');
});