<?php

use Illuminate\Database\Seeder;

class StudentesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('studentes')->insert([
            [
                'mssv' => '12110032',
                'student_name'=>'Huỳnh Quốc Đại',
                'classId'=>'1',
                'scieneId'=>'1',
                'is_female'=>false,
                'is_doanvien'=>true,
                'is_dangvien'=>false,
                'hometown'=>'kp3-TT.Hoà Vinh-Đông Hòa-Phú Yên',
                'number_phone'=>'01689383061',
                'birthday'=>'1996/10/20',
                'email'=>'daihuynh2010@gmail.com',
                'status'=>1
            ],
            [
                'mssv' => '13110113',
                'student_name'=>'Nguyễn Văn Nhàn',
                'classId'=>'2',
                'scieneId'=>'2',
                'is_female'=>false,
                'is_doanvien'=>true,
                'is_dangvien'=>true,
                'hometown'=>'Đồng Nai',
                'number_phone'=>'01219833537',
                'birthday'=>'1995/10/08',
                'email'=>'NguyenVanNhan@gmail.com',
                'status'=>'1'
            ]
        ]);
    }
}
