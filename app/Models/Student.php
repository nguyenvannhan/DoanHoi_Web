<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
     use SoftDeletes;

    protected $table = 'students';
    public $incrementing = true;

    protected $primaryKey = 'mssv';

    protected $fillable = ['name','class_id','science_id','is_female','is_cyu','is_partisan','hometown','number_phone','birthday', 'social_mark', 'email','status', 'is_it_student', 'faculty_id'];
    protected $dates = ['deleted_at', 'created_at', 'updated_at'];

    public $timestamps = true;

    public function ClassOb() {
        return $this->belongsTo('App\Classes', 'classId', 'id');
    }

    public function Science() {
        return $this->belongsTo('App\Science', 'scienceId', 'id');
    }

    public function ActivitiesLeader() {
        return $this->hasMany('App\Activity', 'leader', 'mssv');
    }

    public function BCH_Khoa(){
        return $this->belongsToMany('App\BCH_Khoa');
    }

    public static function getStudentList($id = [], $science_id_list = [], $class_id_list = [], $is_cyu = -1, $is_partisan = -1, $orderByName = '') {
        $studentList = self::orderBy('id', 'desc');

        if(!empty($id)) {
            $studentList = $studentList->whereIn('id', $id);
        }

        if(!empty($science_id_list)) {
            $studentList = $studentList->whereIn('science_id', $science_id_list);
        }

        if(!empty($class_id_list)) {
            $studentList = $studentList->whereIn('class_id', $class_id_list);
        }

        if($is_cyu != -1) {
            $studentList = $studentList->where('is_cyu', $is_cyu);
        }

        if($is_partisan != -1) {
            $studentList = $studentList->where('is_partisan', $is_partisan);
        }

        if($orderByName != '') {
            $studentList = $studentList->orderBy($orderByName, 'desc');
        } else {
            $studentList = $studentList->orderBy('id', 'desc');
        }

        return $studentList->with('ClassOb', 'Science')->get();
    }
}
