<?php

namespace Database\Seeders;

use App\Models\BoardGames;
//use Database\Factories\BoardGamesFactory as FactoriesBoardGamesFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BoardGamesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('boardgames')->insert([
            [
                'name' => 'Catan',
                'slug' => 'catan',
                'min_players' => 2,
                'max_players' => 4,
                'min_age' => 10,
                'duration' => 90,
                'description' => 'Juego de comercio y estrategia',
                'owner_user_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Carcassonne',
                'slug' => 'carcassonne',
                'min_players' => 2,
                'max_players' => 5,
                'min_age' => 8,
                'duration' => 45,
                'description' => 'Construcción de territorio',
                'owner_user_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        BoardGames::factory(20)->create();        
        
    }
}
