<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Check_Number extends Model
{
    protected $table = 'check_number';
    public $incrementing = true;

    protected $primaryKey = 'id';
    protected $fillable = ['activity_id', 'student_id', 'number'];

    protected $dates = ['updated_at', 'created_at'];
    public $timestamps = true;

    public function Student() {
        return $this->belongsTo('App\Models\Student', 'student_id', 'id')->withTrashed();
    }

    public function Activity() {
        return $this->belongsTo('App\Models\Activity', 'activity_id', 'id')->withTrashed();
    }
}
