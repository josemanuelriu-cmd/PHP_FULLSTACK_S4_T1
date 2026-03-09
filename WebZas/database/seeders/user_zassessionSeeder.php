<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class user_zassessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user_zassession')->insert([
            [
                'user_id' => 1, // Ryu
                'zassession_id' => 1, // primera session
            ],
            [
                'user_id' => 1, // Ryu
                'zassession_id' => 2, // segunda session
            ],
            [
                'user_id' => 6, // Ruben
                'zassession_id' => 1, // segunda session
            ],
        ]);
    }
}
