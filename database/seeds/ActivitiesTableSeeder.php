<?php

use Illuminate\Database\Seeder;

class ActivitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('activities')->insert([
            [
                'id' => 'HD001',
                'activityName' => 'Tham du Le Tri an Thay co 20/11',
                'leader' => '13110113',
                'startDate' => DateTime::createFromFormat('m/d/Y', '11/20/2016'),
                'endDate' => DateTime::createFromFormat('m/d/Y', '11/20/2016'),
                'startRegistrationDate' => DateTime::createFromFormat('m/d/Y', '11/13/2016'),
                'endRegistrationDate' => DateTime::createFromFormat('m/d/Y', '11/18/2016'),
                'content' => null,
                'schoolYearId' => 1,
                'conductMark' => 10,
                'socialMark' => 4,
                'activityLevel' => 1,
                'classId' => null,
                'trailer' => null,
                'maxRegisNumber' => 30
            ], [
                'id' => 'HD002',
                'activityName' => 'BTC - CTV Le Tri an Thay co 20/11',
                'leader' => '13110113',
                'startDate' => DateTime::createFromFormat('m/d/Y', '11/20/2016'),
                'endDate' => DateTime::createFromFormat('m/d/Y', '11/20/2016'),
                'startRegistrationDate' => DateTime::createFromFormat('m/d/Y', '11/13/2016'),
                'endRegistrationDate' => DateTime::createFromFormat('m/d/Y', '11/18/2016'),
                'content' => null,
                'schoolYearId' => 1,
                'conductMark' => 10,
                'socialMark' => 4,
                'activityLevel' => 2,
                'classId' => null,
                'trailer' => null,
                'maxRegisNumber' => 30
            ], [
                'id' => 'HD003',
                'activityName' => 'Hoat Dong CTXH tai Nghia Trang Thu Duc',
                'leader' => '13110113',
                'startDate' => DateTime::createFromFormat('m/d/Y', '11/20/2016'),
                'endDate' => DateTime::createFromFormat('m/d/Y', '11/20/2016'),
                'startRegistrationDate' => DateTime::createFromFormat('m/d/Y', '11/13/2016'),
                'endRegistrationDate' => DateTime::createFromFormat('m/d/Y', '11/18/2016'),
                'content' => null,
                'schoolYearId' => 1,
                'conductMark' => 10,
                'socialMark' => 4,
                'activityLevel' => 0,
                'classId' => 1,
                'trailer' => 'https://www.youtube.com/watch?v=wDxcLukjCs8',
                'maxRegisNumber' => 30
            ],

        ]);
    }
}
