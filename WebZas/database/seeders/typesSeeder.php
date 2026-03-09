<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class typesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('types')->insert([
            [
                'type' => 'abstracto',
                'description' => 'Juego centrado en la estrategia pura, caracterizado por la ausencia de un tema narrativo o ambientación fuerte.',                
            ],
            [
                'type' => 'ameritrash',
                'description' => '',
            ],
            [
                'type' => 'cartas',
                'description' => '',
            ],
            [
                'type' => 'clásico',
                'description' => '',
            ],
            [
                'type' => 'colocación de trabajadores',
                'description' => '',
            ],
            [
                'type' => 'construcción de mazos',
                'description' => '',
            ],
            [
                'type' => 'cooperativo',
                'description' => '',
            ],
            [
                'type' => 'dados',
                'description' => '',
            ],
            [
                'type' => 'escape room',
                'description' => '',
            ],
            [
                'type' => 'estrategia',
                'description' => '',
            ],
            [
                'type' => 'eurogame',
                'description' => '',
            ],
            [
                'type' => 'familiar',
                'description' => '',
            ],
            [
                'type' => 'filler',
                'description' => '',
            ],
            [
                'type' => 'infantil',
                'description' => '',
            ],
            [
                'type' => 'investigacion',
                'description' => '',
            ],
            [
                'type' => 'mayorias',
                'description' => '',
            ],
            [
                'type' => 'narrativo',
                'description' => '',
            ],
            [
                'type' => 'party',
                'description' => '',
            ],
            [
                'type' => 'roles ocultos',
                'description' => '',
            ],
            [
                'type' => 'wargame',
                'description' => '',
            ]
        ]);
    }
}
