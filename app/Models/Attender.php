<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attender extends Model {
    use SoftDeletes;

    protected $table = 'attenders';
    public $incrementing = false;

    protected $primaryKey = ['activity_id', 'student_id'];
    protected $fillable = ['check'];

    protected $dates = ['deleted_at', 'updated_at', 'created_at'];
    public $timestamps = true;


}
