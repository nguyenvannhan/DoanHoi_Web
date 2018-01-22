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

// Route::get('/', 'HomeController@AdminDashboard')->name('index_route');


// Auth::routes();

$number_regex = '[0-9\.]+';

Route::get('login', 'HomeController@getLogin')->name('get_login_route');
Route::post('login', 'HomeController@postLogin')->name('post_login_route');

Route::get('logout', 'HomeController@getLogout')->name('get_logout_route');
Route::middleware(['auth'])->group(function() use($number_regex) {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/profile', 'HomeController@profile')->name('profile');
    Route::get('/doi-mat-khau', 'HomeController@getChangePass')->name('get_change_pass_route');
    Route::post('/doi-mat-khau', 'HomeController@postChangePass')->name('post_change_pass_route');

    Route::prefix('sinh-vien')->group(function() use($number_regex) {
        Route::get('/', 'StudentController@getStudentList')->name('student_index_route');

        Route::get('info/{id}', 'StudentController@getInfoStudent')->name('get_info_student_route')->where(['id' => $number_regex]);

        Route::get('them','StudentController@getAddStudent')->name('get_student_add_route')->middleware('admin');
        Route::post('them','StudentController@postAddStudent')->name('post_student_add_route')->middleware('admin');

        Route::get('cap-nhat/{id}','StudentController@getEditStudent')->name('get_edit_student_route')->where(['id' => $number_regex])->middleware('exbch');
        Route::post('cap-nhat/{id}','StudentController@postEditStudent')->name('post_edit_student_route')->where(['id' => $number_regex])->middleware('exbch');

        Route::post('xoa', 'StudentController@postDeleteStudent')->name('get_delete_student_route')->middleware('admin');

        Route::get('lay-danh-sach/{type_id}', 'StudentController@ajaxGetStudentList')->name('get_ajax_student_list');

        Route::get('lay-thong-tin/{id}', 'StudentController@ajaxGetStudentInfo')->name('get_ajax_student_info')->where(['id' => $number_regex]);

        Route::get('get-info-add-student/{is_it_student}/{science_id?}', 'StudentController@ajaxGetInfoAddStudent')->name('ajax_get_info_student')->where(['is_it_student' => $number_regex, 'science_id' => $number_regex]);

        Route::get('add-list', 'StudentController@getAddList')->name('student_get_add_list_route')->middleware('admin');
        Route::post('add-list', 'StudentController@postAddList')->name('student_post_add_list_route')->middleware('admin');
        Route::post('submit-student-list', 'StudentController@postSubmitStudentList')->name('student_post_submit_student_list')->middleware('admin');

        Route::get('add-update-status', 'StudentController@getAddStatusList')->name('student_get_add_status_list_route')->middleware('exbch');
        Route::post('add-update-status', 'StudentController@postAddStatusList')->name('student_post_add_status_list_route')->middleware('exbch');
        Route::post('submit-update-status-list', 'StudentController@postSubmitStatusStudentList')->name('student_post_submit_status_student_list')->middleware('exbch');

        Route::get('xuat-ds-sv', 'StudentController@getExportList')->name('student_get_export_list_route');
        Route::post('xuat-ds-sv-get-list', 'StudentController@postGetExportList')->name('student_post_get_export_list_route');
    });

    Route::prefix('doan-dang')->group(function() use($number_regex) {
        Route::get('/', 'UnionistsController@getUnionistList')->name('get_unioinist_list');
        Route::get('chi-bo', 'UnionistsController@getPartisanList')->name('get_partisan_list');

        Route::post('add-partisan', 'UnionistsController@postAddPartisan')->name('post_add_partisan')->middleware('admin');

        Route::post('ajax-change-class', 'UnionistsController@getAjaxUnionitList')->name('post_get_list_change_class');
        Route::post('delete-partisan', 'UnionistsController@postAjaxDeletePartisan')->name('post_delete_partisan')->middleware('admin');
        Route::post('export-cyu', 'UnionistsController@postAjaxExportUnionist')->name('post_export_unionist');
        Route::post('export-partisan', 'UnionistsController@postAjaxExportPartisan')->name('post_export_partisan');


        Route::post('update-cyu', 'UnionistsController@postUpdateUnionist')->name('post_update_cyu')->middleware('exbch');
        Route::get('import-ds-cyu', 'UnionistsController@getImportFileCYU')->name('get_import_file_cyu')->middleware('exbch');
        Route::post('import-ds-cyu', 'UnionistsController@postImportFileCYU')->name('post_import_file_cyu')->middleware('exbch');
        Route::post('submit-import-ds-cyu', 'UnionistsController@postSubmitImportFileCYU')->name('post_submit_import_file_cyu')->middleware('exbch');
    });

    Route::middleware(['admin'])->group(function() use($number_regex) {

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
        Route::prefix('lop-hoc')->group(function() use($number_regex) {
            Route::get('/', 'ClassesController@getClassList')->name('class_index_route');

            Route::get('search/{scienceId}', 'ClassesController@getClassListByScienceId')->name('class_search_route')->where(['scienceId' => $number_regex]);

            Route::post('them-moi', 'ClassesController@postAddClass')->name('post_add_class_route');
            Route::post('cap-nhat/{id}', 'ClassesController@postEditClass')->name('post_edit_class_route')->where(['id' => $number_regex]);

            Route::post('xoa', 'ClassesController@postDeleteClass')->name('get_delete_class_route');
        });
    });
    //Route activities
    Route::prefix('hoat-dong')->group(function() use($number_regex) {
        Route::get('/', 'ActivityController@getActivityList')->name('activity_index_route');
        Route::get('/get-activity-list/{schoolyear_id}', 'ActivityController@getActivityListBySchoolYear')->name('ajax_get_list_by_schoolyear');

        Route::get('detail/{id}', 'ActivityController@getDetailActivity')->name('activity_detail_route')->where(['id' => $number_regex]);

        Route::get('them-moi', 'ActivityController@getAddActivity')->name('get_activity_add_route')->middleware('exbch');
        Route::post('them-moi', 'ActivityController@postAddActivity')->name('post_activity_add_route')->middleware('exbch');

        Route::get('cap-nhat/{id}', 'ActivityController@getEditActivity')->name('get_edit_activity_route')->where(['id' => $number_regex])->middleware('exbch');
        Route::post('cap-nhat/{id}', 'ActivityController@postEditActivity')->name('post_edit_activity_route')->where(['id' => $number_regex])->middleware('exbch');

        Route::post('xoa', 'ActivityController@postDeleteActivity')->name('post_delete_activity_route')->middleware('exbch');

        Route::get('get-leader/{searchKey}', 'ActivityController@ajaxGetLeader')->name('ajax_get_leader');
        Route::get('get-class/{student_id}', 'ActivityController@ajaxGetClass')->name('ajax_get_classs')->where(['student_id' => $number_regex]);

        Route::prefix('tham-gia')->group(function() use($number_regex) {
            Route::get('/', 'AttenderController@index')->name('get_attender_index_route');
            Route::get('/lay-danh-sach/{activity_id}', 'AttenderController@getAttenderList')->name('ajax_get_attender_list')->where(['activity_id' => $number_regex]);
            Route::post('/check-attend', 'AttenderController@postCheckAttend')->name('ajax_post_check_attend')->middleware('exbch');

            Route::get('/get-activity-list-attender/{schoolyear_id}', 'AttenderController@getActivityListBySchoolYear')->name('ajax_get_list_by_schoolyear_attender')->where(['schoolyear_id' => $number_regex]);
            Route::get('/get-student-info/{id}', 'AttenderController@getStudentInfo')->name('ajax_get_student_info_attender')->where(['id' => $number_regex]);

            Route::post('add-attender', 'AttenderController@postAddAttender')->name('post_add_attender_route')->middleware('exbch');
            Route::post('update-mark', 'AttenderController@postUpdateMark')->name('post_update_mark_route')->middleware('exbch');
            Route::post('delete-attender', 'AttenderController@postDeleteAttender')->name('post_delete_attender_route')->middleware('exbch');

            Route::get('diem-danh', 'AttenderController@getCheck')->name('get_check_attender_route')->middleware('exbch');
            Route::post('diem-danh', 'AttenderController@postCheck')->name('post_check_attender_route')->middleware('exbch');
            Route::post('get-check', 'AttenderController@postGetCheckList')->name('post_get_check_list_route')->middleware('exbch');
            Route::post('export-check-number', 'AttenderController@postExportNumberCheck')->name('post_export_check_number');

            Route::get('import-attender-list', 'AttenderController@getImportAttenderList')->name('get_import_attender_list_route')->middleware('exbch');
            Route::post('import-attender-list', 'AttenderController@postImportAttenderList')->name('post_import_attender_list_route')->middleware('exbch');
            Route::post('submit-import-attender-list', 'AttenderController@postSubmitImportAttenderList')->name('post_submit_attender_list_route')->middleware('exbch');

            Route::get('import-mark-list', 'AttenderController@getImportMarkList')->name('get_import_mark_list_route')->middleware('exbch');
            Route::post('import-mark-list', 'AttenderController@postImportMarkList')->name('post_import_mark_list_route')->middleware('exbch');
            Route::post('submit-import-mark-list', 'AttenderController@postSubmitImportMarkList')->name('post_submit_import_mark_list_route')->middleware('exbch');

            Route::post('submit-export-mark-list', 'AttenderController@postExportExcelAttenderList')->name('post_submit_export_mark_list_route');
        });
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
    Route::prefix('ajax')->group(function() use($number_regex) {
        Route::post('add-science', 'ScienceController@postAjaxAddScience')->name('ajax_add_science_route');

        Route::post('add-school-year', 'School_YearController@postAjaxAddSchoolYear')->name('ajax_add_school_year');

        Route::get('get-class-info/{class_id}', 'ClassesController@ajaxGetClassInfo')->name('ajax_get_class_info')->where(['class_id' => $number_regex]);

        Route::get('add-BCH_Khoa','BCH_KhoaController@getAjaxAddBCH_khoa')->name('ajax_add_BCH_Khoa_route');
    });

    Route::middleware(['admin'])->group(function() {
        Route::prefix('tai-khoan')->group(function() {
            Route::get('/', 'AccountController@index')->name('account_index_route');
            Route::post('/register', 'AccountController@postCreateAccount')->name('create_account_route');
            Route::post('/reset', 'AccountController@postResetAccount')->name('reset_account_route');
            Route::post('/xoa', 'AccountController@postDeleteAccount')->name('delete_account_route');
        });
    });
});
