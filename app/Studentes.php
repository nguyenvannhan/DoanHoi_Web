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
    protected $fillable = ['student_name','classId','scieneId','is_female','is_doanvien','is_dangvien','hometown','number_phone','birthday','email','status'];

    public $timestamps = true;

    public function Classes() {
        return $this->belongsTo('App\Classes', 'classId', 'id');
    }
    public function Science() {
        return $this->belongsTo('App\Science', 'scieneId', 'id');
    }
}
