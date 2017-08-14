<?php

use Illuminate\Database\Seeder;

class AttendersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('attenders')->insert([
            [
                'activityId' => 'HD001',
                'studentId' => '13110113',
                'studentName' => 'Nguyễn Văn Nhàn'
            ], [
                'activityId' => 'HD002',
                'studentId' => '13110113',
                'studentName' => 'Nguyễn Văn Nhàn'
            ]
        ]);
    }
}
