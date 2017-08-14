<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class School_Yeares extends Model
{
     use SoftDeletes;

    protected $table = 'school_yeares';
    public $incrementing = true;

    protected $primaryKey = 'id';
    protected $fillable = ['school_year_name'];
    protected $dates = ['deleted_at', 'created_at', 'updated_at'];

    public $timestamps = true;

    public function Activities() {
        return $this->hasMany('App\Acitivity', 'schoolYearId', 'id');
    }
    public function BCH_Khoa(){
        return $this->hasMany('App\BCH_Khoa','school_yearId','school_yearId');
    }
}
