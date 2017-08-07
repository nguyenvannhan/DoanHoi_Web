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
                'nameClass' => '121101',
                'scienceId' => '1'
            ],
            [
                'nameClass' => '121102',
                'scienceId' => '1'
            ],
            [
                'nameClass' => '121103',
                'scienceId' => '1'
            ],
            [
                'nameClass' => '129100',
                'scienceId' => '1'
            ]
        ]);
    }
}
