<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class School_Year extends Model
{
     use SoftDeletes;

    protected $table = 'school_years';
    public $incrementing = true;

    protected $primaryKey = 'id';
    protected $fillable = ['name'];
    protected $dates = ['deleted_at', 'created_at', 'updated_at'];

    public $timestamps = true;

    public function Activities() {
        return $this->hasMany('App\Acitivity', 'school_year_id', 'id');
    }
}
