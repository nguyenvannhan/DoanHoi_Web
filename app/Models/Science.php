<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Science extends Model {
    use SoftDeletes;

    protected $table = 'sciences';
    public $incrementing = true;

    protected $primaryKey = 'id';
    protected $fillable = ['name'];
    protected $dates = ['deleted_at', 'created_at', 'updated_at'];

    public $timestamps = true;

    public function Classes() {
        return $this->hasMany('App\Models\Classes', 'science_id', 'id');
    }
    public function Students(){
    	return $this->hasMany('App\Models\Students','science_id','id');
    }
}
