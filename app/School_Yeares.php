<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class School_Yeares extends Model
{
     use SoftDeletes;

    protected $table = 'school_yeares';
    public $incrementing = true;

    protected $primaryKey = 'id';
    protected $fillable = ['school_year_name'];

    public $timestamps = true;
}
