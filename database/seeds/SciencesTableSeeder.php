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
                'nameScience' => '2012'
            ],
            [
                'nameScience' => '2013'
            ]
        ]);
    }
}
