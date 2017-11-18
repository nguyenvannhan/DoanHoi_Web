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

Route::prefix('sinh-vien')->group(function() {
    Route::get('/', 'StudentController@getStudentList')->name('student_index_route');

    Route::get('info/{id}', 'StudentController@getInfoStudent')->name('get_info_student_route');

    Route::get('them','StudentController@getAddStudent')->name('get_student_add_route');
    Route::post('them','StudentController@postAddStudent')->name('post_student_add_route');

    Route::get('cap-nhat/{id}','StudentController@getEditStudent')->name('get_edit_student_route');
    Route::post('cap-nhat/{id}','StudentController@postEditStudent')->name('post_edit_student_route');

    Route::post('xoa', 'StudentController@postDeleteStudent')->name('get_delete_student_route');

    Route::get('lay-danh-sach/{type_id}', 'StudentController@ajaxGetStudentList')->name('get_ajax_student_list');

    Route::get('lay-thong-tin/{id}', 'StudentController@ajaxGetStudentInfo')->name('get_ajax_student_info');

    Route::get('add-list', function() {
        return view('student.addListStudent');
    })->name('student_add_list_route');
});

//Route science
Route::prefix('khoa-hoc')->group(function() {
    Route::get('/', 'ScienceController@getAllList')->name('science_index_route');
});

//Route chool year
Route::prefix('nam-hoc')->group(function() {
    Route::get('/','School_YearController@getAllList')->name('school_year_index_route');
    Route::get('add','School_YearController@getAddSchool_Year')->name('get_school_year_add_route');
});

//Route class
Route::prefix('lop-hoc')->group(function() {
    Route::get('/', 'ClassesController@getClassList')->name('class_index_route');

    Route::get('search/{scienceId}', 'ClassesController@getClassListByScienceId')->name('class_search_route');

    Route::post('them-moi', 'ClassesController@postAddClass')->name('post_add_class_route');
    Route::post('cap-nhat/{id}', 'ClassesController@postEditClass')->name('post_edit_class_route');

    Route::post('xoa', 'ClassesController@postDeleteClass')->name('get_delete_class_route');
});

//Route activities
Route::prefix('hoat-dong')->group(function() {
    Route::get('/', 'ActivityController@getActivityList')->name('activity_index_route');

    Route::get('detail/{id}', 'ActivityController@getDetailActivity')->name('activity_detail_route');

    Route::get('them-moi', 'ActivityController@getAddActivity')->name('get_activity_add_route');
    Route::post('them-moi', 'ActivityController@postAddActivity')->name('post_activity_add_route');

    Route::get('edit/{activityId}', 'ActivityController@getEditActivity')->name('get_edit_activity_route');
    Route::post('edit/{activityId}', 'ActivityController@postEditActivity')->name('post_edit_activity_route');

    Route::get('add-list', function() {
        return view('activity.addListStudentActivity');
    })->name('get_activity_list_add_route');

    Route::get('add-list-student-activity', function() {
        return view('activity.addListStudentActivity');
    })->name('activity_list_student_route');
});

//Route faculty commitee
Route::prefix('BCH-Khoa')->group(function() {
   Route::get('/{BCH_KhoaId?}', 'BCH_KhoaController@getBCH_KhoaList')->name('BCH_Khoa_index_route');

    Route::get('add-student','BCH_KhoaController@getAddBCH_Khoa_Student')->name('get_BCH_Khoa_Student_add_route');
    Route::post('add-student','BCH_KhoaController@postAddBCH_Khoa_Student')->name('post_BCH_Khoa_Stuent_add_route');

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
    Route::post('add-science', 'ScienceController@postAjaxAddScience')->name('ajax_add_science_route');

    Route::post('add-school-year', 'School_YearController@postAjaxAddSchoolYear')->name('ajax_add_school_year');

    Route::get('get-class-info/{class_id}', 'ClassesController@ajaxGetClassInfo')->name('ajax_get_class_info');

    Route::get('get-info-add-student/{is_it_student}/{science_id?}', 'StudentController@ajaxGetInfoAddStudent')->name('ajax_get_info_student');

    Route::get('get-class-from-student-id/{studentId}','StudentesController@getClassFromId')->name('ajax_get_class_from_student_id');

    Route::get('add-BCH_Khoa','BCH_KhoaController@getAjaxAddBCH_khoa')->name('ajax_add_BCH_Khoa_route');
});
