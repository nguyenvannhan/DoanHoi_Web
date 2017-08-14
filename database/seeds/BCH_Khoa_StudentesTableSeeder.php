<?php

use Illuminate\Database\Seeder;

class BCH_Khoa_StudentesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('bch_khoa_student')->insert([
         	['mssv_student'=> '12110032',
         	'id_bch_khoa'=>'1',
         	'position'=>'5',
            'is_cbdoan'=>'1'
         	],
         	[
         	'mssv_student'=> '13110113',
         	'id_bch_khoa'=>'1',
         	'position'=>'2',
            'is_cbdoan'=>'1'
         	]
         	]);
    }
}
