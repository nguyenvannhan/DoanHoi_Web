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
        return $this->belongsTo('App\Models\Classes', 'classId', 'id');
    }

    public function Science() {
        return $this->belongsTo('App\Models\Science', 'scienceId', 'id');
    }

    public function ActivitiesLeader() {
        return $this->hasMany('App\Models\Activity', 'leader', 'mssv');
    }

    public function BCH_Khoa(){
        return $this->belongsToMany('App\Models\BCH_Khoa');
    }
}
