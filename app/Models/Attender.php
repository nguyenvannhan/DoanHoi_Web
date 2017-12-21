<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attender extends Model {
    use SoftDeletes;

    protected $table = 'attenders';
    public $incrementing = true;

    protected $primaryKey = 'id';
    protected $fillable = ['activity_id', 'student_id', 'time_id', 'check', 'conduct_mark', 'social_mark', 'minus_conduct_mark', 'minus_social_mark'];

    protected $dates = ['deleted_at', 'updated_at', 'created_at'];
    public $timestamps = true;

    public function Student() {
        return $this->belongsTo('App\Models\Student', 'student_id', 'id')->withTrashed();
    }

    public function Activity() {
        return $this->belongsTo('App\Models\Activity', 'activity_id', 'id')->withTrashed();
    }
}
