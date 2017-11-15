<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Classes extends Model {
    use SoftDeletes;

    protected $table = 'classes';
    public $incrementing = true;

    protected $primaryKey = 'id';
    protected $fillable = ['name', 'science_id'];
    protected $dates = ['deleted_at', 'created_at', 'updated_at'];

    public $timestamps = true;

    public function Science() {
        return $this->belongsTo('App\Models\Science', 'science_id', 'id');
    }
    public function Students(){
    	return $this->hasMany('App\Models\Student','class_id','id');
    }

    public function Activities() {
        return $this->hasMany('App\Models\Activity', 'class_id', 'id');
    }
}
