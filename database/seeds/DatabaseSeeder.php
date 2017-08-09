<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(UsersTableSeeder::class);
        $this->call(SciencesTableSeeder::class);
        $this->call(ClassesTableSeeder::class);
        $this->call(SchoolYearesTableSeeder::class);
        $this->call(StudentesTableSeeder::class);
        $this->call(ActivitiesTableSeeder::class);
    }
}


