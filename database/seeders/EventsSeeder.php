<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('events')->insert([
            [
                'title' => 'Infotel',
                'description' => 'Infotel Annual Event',
                'location' => 'BMICH',
                'long' => '6.901966123343937',
                'latt' => '79.87339605530008',
                'start_date' => '2021-07-14 00:00:00',
                'end_date' => '2021-07-16 00:00:00',
            ],
            [
                'title' => 'Google IO',
                'description' => 'Google IO Annual Event organized by Google Inc.',
                'location' => 'Sri Lanka Exhibition & Convention Centre',
                'long' => '6.932610753349443',
                'latt' => '79.84941487064081',
                'start_date' => '2021-08-01 00:00:00',
                'end_date' => '2021-08-02 00:00:00',
            ],
            [
                'title' => 'SLIIT Exhibishio',
                'description' => 'Google IO Annual Event organized by Google Inc.',
                'location' => 'SLIIT',
                'long' => '6.915013720965899',
                'latt' => '79.97290506895284',
                'start_date' => '2021-09-10 00:00:00',
                'end_date' => '2021-09-12 00:00:00',
            ]
        ]);
    }
}
