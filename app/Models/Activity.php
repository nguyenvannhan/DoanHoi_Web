<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activity extends Model {
    use SoftDeletes;

    protected $table = 'activities';
    public $incrementing = false;

    protected $primaryKey = 'id';
    protected $fillable = ['name', 'leader', 'start_date', 'end_date', 'start_regis_date', 'end_regis_date',
        'content', 'school_year_id', 'conduct_mark', 'social_mark', 'activity_level', 'class_id', 'trailer', 'max_regis_number'];
    protected $dates = ['deleted_at', 'created_at', 'updated_at'];

    public $timestamps = true;

    public function Leader() {
        return $this->belongsTo('App\Students', 'leader', 'id');
    }

    public function ClassOb() {
        return $this->belongsTo('App\Classes', 'class_id', 'id');
    }

    public function SchoolYear() {
        return $this->belongsTo('App\School_Years', 'school_year_id', 'id');
    }
}
