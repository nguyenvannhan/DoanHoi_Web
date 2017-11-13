<?php

use Illuminate\Database\Seeder;

class FacultyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('faculties')->insert([
            [
                'name' => 'Công nghệ Thông Tin'
            ],[
                'name' => 'CN Hóa Học & Thực Phẩm'
            ],[
                'name' => 'Cơ khí Chế tạo máy'
            ]
        ]);
    }
}
