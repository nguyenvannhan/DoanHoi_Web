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
                'id' => 'KH12',
                'nameScience' => '2012'
            ],
            [
                'id' => 'KH13',
                'nameScience' => '2013'
            ]
        ]);
    }
}
