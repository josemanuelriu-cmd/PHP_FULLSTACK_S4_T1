<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          DB::table('users')->insert([
            'num_partner' => 1,
            'nickname' => 'testuser',
            'name' => 'Test User',
            'password' => bcrypt('password'),
            'type' => 'admin',
            'registration_date' => now(),
            'email' => 'test@example.com',
            'telephone' => '1234567890',
            'age' => 30,
        ]);
    }
}
