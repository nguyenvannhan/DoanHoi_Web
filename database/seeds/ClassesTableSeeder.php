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
                'id' => '121',
                'nameClass' => '121101',
                'scienceId' => 'KH12'
            ],
            [
                'id' => '122',
                'nameClass' => '121102',
                'scienceId' => 'KH12'
            ],
            [
                'id' => '123',
                'nameClass' => '121103',
                'scienceId' => 'KH12'
            ],
            [
                'id' => '129',
                'nameClass' => '129100',
                'scienceId' => 'KH12'
            ]
        ]);
    }
}
