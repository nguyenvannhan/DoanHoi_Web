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

    public static function getFacultyList($is_other_faculty = false, $id_list = []) {
        $facultyList = self::orderBy('id', 'asc');

        if($is_other_faculty) {
            $facultyList = $facultyList->where('id', 1);
        }

        if(!empty($id_list)) {
            $facultyList = $facultyList->whereIn('id', $id_list);
        }

        return $facultyList->with('Students')->get();
    }
}
