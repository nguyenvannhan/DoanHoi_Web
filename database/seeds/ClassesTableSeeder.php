<?php

use Illuminate\Database\Seeder;

class ClassesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('classes')->insert([
            [
                'name' => '121101',
                'science_id' => '1'
            ],
            [
                'name' => '121102',
                'science_id' => '1'
            ],
            [
                'name' => '121103',
                'science_id' => '1'
            ],
            [
                'name' => '129100',
                'science_id' => '1'
            ]
        ]);
    }
}
