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
    });

    Route::get('add', function() {
        return view('student.addStudent');
    });

    Route::get('add-list', function() {
        return view('student.addListStudent');
    });
});
