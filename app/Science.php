<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Science extends Model {
    use SoftDeletes;

    protected $table = 'sciences';
    public $incrementing = true;

    protected $primaryKey = 'id';
    protected $fillable = ['nameScience'];

    public $timestamps = true;

    public function Classes() {
        return $this->hasMany('App\Classes', 'scienceId', 'id');
    }
    public function Studentes(){
    	return $this->hasMany('App\Studentes','scienceId','mssv');
    }
}
