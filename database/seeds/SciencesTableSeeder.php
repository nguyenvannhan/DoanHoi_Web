<?php

use Illuminate\Database\Seeder;

class SciencesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sciences')->insert([
            [
                'name' => '2012'
            ],[
                'name' => '2013'
            ],[
                'name' => '2014'
            ],[
                'name' => '2015'
            ],[
                'name' => '2016'
            ],[
                'name' => '2017'
            ]
        ]);
    }
}
