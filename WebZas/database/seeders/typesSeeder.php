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
            ],
            [
                'type' => 'ameritrash',
            ],
            [
                'type' => 'cartas',
            ],
            [
                'type' => 'clásico',
            ],
            [
                'type' => 'colocación de trabajadores',
            ],
            [
                'type' => 'construcción de mazos',
            ],
            [
                'type' => 'cooperativo',
            ],
            [
                'type' => 'dados',
            ],
            [
                'type' => 'escape room',
            ],
            [
                'type' => 'estrategia',
            ],
            [
                'type' => 'eurogame',
            ],
            [
                'type' => 'familiar',
            ],
            [
                'type' => 'filler',
            ],
            [
                'type' => 'infantil',
            ],
            [
                'type' => 'investigacion',
            ],
            [
                'type' => 'mayorias',
            ],
            [
                'type' => 'narrativo',
            ],
            [
                'type' => 'party',
            ],
            [
                'type' => 'roles ocultos',
            ],
            [
                'type' => 'wargame',
            ]
        ]);
    }
}
