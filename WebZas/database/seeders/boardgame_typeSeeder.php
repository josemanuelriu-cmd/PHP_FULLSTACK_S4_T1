<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class boardgame_typeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('boardgame_type')->insert([
            [
                'boardgame_id' => 1, // Catan
                'type_id' => 8, // dados
            ],
            [
                'boardgame_id' => 1, // Catan
                'type_id' => 10, // estrategia
            ],
            [
                'boardgame_id' => 1, // Catan
                'type_id' => 12, // familiar
            ],
            [
                'boardgame_id' => 2, // Carcassonne
                'type_id' => 5, // colocación de trabajadores
            ],
            [
                'boardgame_id' => 2, // Carcassonne
                'type_id' => 10, // estrategia
            ],
            [
                'boardgame_id' => 2, // Carcassonne
                'type_id' => 11, // eurogame
            ],
            [
                'boardgame_id' => 3, // Bang
                'type_id' => 1, // abstracto
            ],
            [
                'boardgame_id' => 3, // Bang
                'type_id' => 3, // cartas
            ],
            [
                'boardgame_id' => 3, // Bang
                'type_id' => 10, // estrategia
            ],
            [
                'boardgame_id' => 3, // Bang
                'type_id' => 19, // roles ocultos
            ],
        ]);
    }
}
