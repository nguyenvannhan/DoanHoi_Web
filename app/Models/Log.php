<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Request;
use App\Models\Student;
use Auth;

class Log extends Model
{
    protected $table = 'logs';
    public $incrementing = true;

    protected $primaryKey = 'id';
    protected $fillable = ['student_id','student_name', 'action', 'old_data', 'new_data', 'time_id', 'url', 'agent'];
    protected $dates = ['created_at', 'updated_at'];

    public $timestamps = true;

    public static function addToLog($subject, $old_data, $new_data) {
        if(Auth::user()->student_id != 'admin') {
            $student = Student::find(Auth::user()->student_id);
        } else {
            $student = new Student;
            $student->id = 0;
            $student->name = 'admin';
        }

        $log = [];
        $log['student_id']      = $student->id;
        $log['student_name']    = $student->name;
        $log['action']          = $subject;
        $log['old_data']        = $old_data;
        $log['new_data']        = $new_data;
        $log['url']             = Request::fullUrl();
        $log['agent']           = Request::header('user-agent');

        Log::create($log);
    }

    public static function getAll() {
        return Log::orderBy('time_id', 'desc')->get();
    }
}
