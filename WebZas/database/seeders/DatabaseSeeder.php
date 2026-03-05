<?php

namespace Database\Seeders;

use App\Models\boardgames;
use App\Models\types;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            UserSeeder::class,
            BoardGamesSeeder::class,
            sessions_zasSeeder::class,
            typesSeeder::class,
            boardgame_typeSeeder::class,
        ]);

       
    }
}
