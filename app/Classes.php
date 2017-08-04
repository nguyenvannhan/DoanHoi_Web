<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Classes extends Model {
    use SoftDeletes;

    protected $table = 'classes';
    public $incrementing = true;

    protected $primaryKey = 'id';
    protected $fillable = ['nameClass', 'scienceId'];

    public $timestamps = true;

    public function Science() {
        return $this->belongsTo('App\Science', 'scienceId', 'id');
    }
}
