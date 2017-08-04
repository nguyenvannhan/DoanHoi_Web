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
        DB::table('school_yeares')->insert([
            [
                'school_year_name' => '2012 - 2013'
            ],
            [
                'school_year_name' => '2013 - 2014'
            ]
        ]);
    }
}
