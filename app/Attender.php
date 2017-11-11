<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attender extends Model {
    use SoftDeletes;

    protected $table = 'attenders';
    public $incrementing = false;

    protected $primaryKey = ['activityId', 'studentId'];
    protected $fillable = ['studentName', 'phone', 'email'];

    protected $dates = ['deleted_at', 'updated_at', 'created_at'];
    public $timestamps = true;


}
