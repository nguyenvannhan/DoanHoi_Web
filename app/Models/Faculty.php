<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faculty extends Model {
    use SoftDeletes;

    protected $table = 'faculties';
    public $incrementing = true;

    protected $primaryKey = 'id';
    protected $fillable = ['name'];
    protected $dates = ['deleted_at', 'created_at', 'updated_at'];

    public $timestamps = true;

    public function Students() {
        return $this->hasMany('App\Models\Student', 'faculty_id', 'id');
    }
}
