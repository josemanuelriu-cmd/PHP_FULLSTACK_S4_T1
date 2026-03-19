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
                'user_id' => 1, 
                'zassession_id' => 1,
            ],
            [
                'user_id' => 1, 
                'zassession_id' => 2, 
            ],
            [
                'user_id' => 1, 
                'zassession_id' => 3, 
            ],
            [
                'user_id' => 6, 
                'zassession_id' => 1, 
            ],
            [
                'user_id' => 9, 
                'zassession_id' => 1,
            ],
            [
                'user_id' => 10, 
                'zassession_id' => 1,
            ],
            [
                'user_id' => 11, 
                'zassession_id' => 1,
            ],
            [
                'user_id' => 12, 
                'zassession_id' => 1,
            ],
            [
                'user_id' => 13, 
                'zassession_id' => 1,
            ],
            [
                'user_id' => 14, 
                'zassession_id' => 1,
            ],
            [
                'user_id' => 9, 
                'zassession_id' => 2, 
            ],
            [
                'user_id' => 10, 
                'zassession_id' => 2, 
            ]
        ]);
    }
}
