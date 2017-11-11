<?php

use Illuminate\Database\Seeder;

class BCHKhoaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('bch_khoa')->insert([
	            [
	                'school_yearId'=>'1',
	            ],
	            [
	                'school_yearId'=>'1',
	            ],
            ]);
    }
}
