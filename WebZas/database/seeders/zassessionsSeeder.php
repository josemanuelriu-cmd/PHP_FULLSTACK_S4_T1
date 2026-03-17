<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class zassessionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('zassessions')->insert([
            [
                'date' => '2026-03-20',
                'name' => 'Can Verdaguer',
                'event_name' => 'Viernes de ZAS',
                'start_time' => '17:00:00',
                'end_time' => '21:00:00',
                'max_users' => 15,
                'direction' => 'Carrer de Piferrer, 111, 08016 Barcelona',
                'latitude' => 41.434088,
                'longitude' => 2.179224,
                'created_at' => now(),
            ],
            [
                'date' => '2026-03-21',
                'name' => 'Can Verdaguer',
                'event_name' => 'Sabados de ZAS',
                'start_time' => '10:00:00',
                'end_time' => '14:00:00',
                'max_users' => 15,
                'direction' => 'Carrer de Piferrer, 111, 08016 Barcelona',
                'latitude' => 41.434088,
                'longitude' => 2.179224,
                'created_at' => now(),
            ],
            [
                'date' => '2026-03-27',
                'name' => 'Can Verdaguer',
                'event_name' => 'Viernes de ZAS',
                'start_time' => '17:00:00',
                'end_time' => '21:00:00',
                'max_users' => 15,
                'direction' => 'Carrer de Piferrer, 111, 08016 Barcelona',
                'latitude' => 41.434088,
                'longitude' => 2.179224,
                'created_at' => now(),
            ],
            [
                'date' => '2026-03-28',
                'name' => 'Can Verdaguer',
                'event_name' => 'Sabados de ZAS',
                'start_time' => '10:00:00',
                'end_time' => '14:00:00',
                'max_users' => 15,
                'direction' => 'Carrer de Piferrer, 111, 08016 Barcelona',
                'latitude' => 41.434088,
                'longitude' => 2.179224,
                'created_at' => now(),
            ]
        ]);
    }
}
