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
                'type_id' => 10, // estrategia
            ],
            [
                'boardgame_id' => 1, // Catan
                'type_id' => 12, // familiar
            ],
            [
                'boardgame_id' => 2, // Carcassonne
                'type_id' => 10, // estrategia
            ],
            [
                'boardgame_id' => 2, // Carcassonne
                'type_id' => 5, // colocación de trabajadores
            ],
        ]);
    }
}
