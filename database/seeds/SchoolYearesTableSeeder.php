<?php

use Illuminate\Database\Seeder;

class SchoolYearesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('school_years')->insert([
            [
                'name' => '2017 - 2018'
            ]
        ]);
    }
}
