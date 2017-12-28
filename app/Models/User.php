<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

     protected $table = "users";

    protected $fillable = [
        'student_id', 'password', 'level'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function IsAdmin() {
        if($this->student_id == 'admin') {
            return true;
        } else {
            return false;
        }
    }

    public function Student() {
        return $this->belongsTo('App\Models\Student', 'student_id', 'id');
    }

    public static function getAccountList() {
        $accountList = self::with('Student')->where('level', '<>', 0)->where('student_id', '<>', Auth::user()->student_id)->get();
        return $accountList;
    }
}
