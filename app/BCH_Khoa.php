<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BCH_Khoa extends Model
{
    use SoftDeletes;

    protected $table = 'bch_khoa';
    public $incrementing = true;

    protected $primaryKey = ['id'];
    protected $fillable = ['school_yearId'];
    protected $dates = ['deleted_at', 'created_at', 'updated_at'];

    public $timestamps = true;

     public function School_Yeares()
    {
        return $this->belongsTo('App\School_Yeares','school_yearId','id');
    }

    
    public function studentes(){
        return $this->belongsToMany('App\Studentes', 'bch_khoa_student', 'id_bch_khoa', 'mssv_student');
    }
}
