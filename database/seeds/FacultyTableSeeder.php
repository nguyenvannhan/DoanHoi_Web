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
                'name' => 'CN Hóa học & Thực Phẩm'
            ],[
                'name' => 'Cơ khí Chế tạo máy'
            ],[
                'name' => 'CN may và Thời trang'
            ],[
                'name' => 'ĐT Chất lượng cao'
            ],[
                'name' => 'Điện - Điện tử'
            ],[
                'name' => 'In - Truyền Thông'
            ],[
                'name' => 'Khoa học Ứng dụng'
            ],[
                'name' => 'Kinh tế'
            ],[
                'name' => 'Xây dựng'
            ],[
                'name' => 'Ngoại ngữ'
            ]
        ]);
    }
}
