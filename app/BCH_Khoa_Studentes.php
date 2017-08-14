<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BCH_Khoa_Studentes extends Model
{
     use SoftDeletes;

    protected $table = 'bch_khoa_student';
    public $incrementing = true;

    protected $primaryKey = ['id_bch_khoa','mssv_student'];
    protected $fillable = ['position','is_bch_doan'];
    protected $dates = ['deleted_at', 'created_at', 'updated_at'];

    public $timestamps = true;

}
