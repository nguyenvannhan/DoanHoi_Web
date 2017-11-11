<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Classes extends Model {
    use SoftDeletes;

    protected $table = 'classes';
    public $incrementing = true;

    protected $primaryKey = 'id';
    protected $fillable = ['nameClass', 'scienceId'];
    protected $dates = ['deleted_at', 'created_at', 'updated_at'];

    public $timestamps = true;

    public function Science() {
        return $this->belongsTo('App\Science', 'scienceId', 'id');
    }
    public function Studentes(){
    	return $this->hasMany('App\Studentes','classId','mssv');
    }

    public function Activities() {
        return $this->hasMany('App\Activity', 'classId', 'id');
    }
}
