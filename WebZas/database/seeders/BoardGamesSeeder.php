<?php

namespace Database\Seeders;

use App\Models\BoardGames;
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
                'description' => 'Juego con un sistema de comercio, donde los jugadores pueden intercambiar cartas de su mano entre ellos para construir carreteras, pueblos, etc',
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
                'description' => 'Ambientado en la ciudad medieval amurallada francesa de Carcasona, el juego consiste en crear un mapa de juego donde los jugadores compiten por hacer el máximo número de puntos con las mejores posesiones (ciudades, praderas, caminos y monasterios) del mapa',
                'owner_user_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bang!',
                'slug' => 'bang1',
                'min_players' => 3,
                'max_players' => 7,
                'min_age' => 12,
                'duration' => 30,
                'description' => 'Popular juego de cartas de roles ocultos y estrategia ambientado en el Salvaje Oeste',
                'owner_user_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        BoardGames::factory(10)->create();        
        
    }
}
