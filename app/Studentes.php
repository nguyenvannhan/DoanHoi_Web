<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Studentes extends Model
{
     use SoftDeletes;

    protected $table = 'studentes';
    public $incrementing = true;

    protected $primaryKey = 'mssv';

    protected $fillable = ['student_name','classId','scienceId','is_female','is_doanvien','is_dangvien','hometown','number_phone','birthday','email','status'];
    protected $dates = ['deleted_at', 'created_at', 'updated_at'];

    public $timestamps = true;

    public function Classes() {
        return $this->belongsTo('App\Classes', 'classId', 'id');
    }

    public function Science() {
        return $this->belongsTo('App\Science', 'scienceId', 'id');
    }

    public function ActivitiesLeader() {
        return $this->hasMany('App\Activity', 'leader', 'mssv');
    }

    public function BCH_Khoa(){
        return $this->belongsToMany('App\BCH_Khoa')->using('App\BCH_Khoa_Studentes');
    }
}
