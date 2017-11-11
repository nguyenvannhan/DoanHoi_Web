<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activity extends Model {
    use SoftDeletes;

    protected $table = 'activities';
    public $incrementing = false;

    protected $primaryKey = 'id';
    protected $fillable = ['activityName', 'leader', 'startDate', 'endDate', 'startRegistrationDate', 'endRegistrationDate',
        'content', 'schoolYearId', 'conductMark', 'socialMark', 'activityLevel', 'classId', 'trailer', 'maxRegisNumber'];
    protected $dates = ['deleted_at', 'created_at', 'updated_at'];

    public $timestamps = true;

    public function Leader() {
        return $this->belongsTo('App\Studentes', 'leader', 'mssv');
    }

    public function ClassOb() {
        return $this->belongsTo('App\Classes', 'classId', 'id');
    }

    public function SchoolYear() {
        return $this->belongsTo('App\School_Yeares', 'schoolYearId', 'id');
    }
}
