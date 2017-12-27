<?php

use Illuminate\Database\Seeder;
use App\Models\Users;

class UserSeederTable extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        DB::table('users')->insert([
            [
                'student_id' => 'admin',
                'password' =>  bcrypt("123456"),
                'level' => 0
            ]
        ]);
    }
}
