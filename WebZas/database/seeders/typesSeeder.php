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
                'description' => 'Un juego de mesa Ameritrash (o Ameri-games) es un estilo caracterizado por priorizar la temática, la narrativa y la inmersión sobre la mecánica, destacando por sus componentes de alta calidad, especialmente miniaturas. Originarios de EE. UU., suelen incluir conflicto directo, fuerte azar (dados/cartas) y una experiencia de aventura épica.',
            ],
            [
                'type' => 'cartas',
                'description' => 'Un juego de mesa de cartas es aquel cuyo componente principal o único son las cartas (barajas), diseñado para ser portátil, rápido y con alta rejugabilidad, sin necesidad de tablero físico. Se basan en mecánicas de gestión de mano, robar/descartar, o construcción de mazos (deckbuilding) para lograr un objetivo.',
            ],
            [
                'type' => 'clásico',
                'description' => 'Un juego de mesa clásico es una actividad lúdica tradicional, con reglas sencillas y atemporales que se han transmitido de generación en generación, centrada en la interacción social y, a menudo, la nostalgia. Ejemplos incluyen el Ajedrez, Parchís, Dominó, Monopoly y Risk, caracterizados por ser incombustibles y familiares.',
            ],
            [
                'type' => 'colocación de trabajadores',
                'description' => 'Un juego de mesa de colocación de trabajadores (worker placement) es un género donde los jugadores sitúan peones o fichas (trabajadores) en espacios específicos del tablero para activar acciones o recursos. La clave es que la mayoría de los espacios son limitados, bloqueando las opciones para los rivales y exigiendo planificación estratégica a largo plazo.',
            ],
            [
                'type' => 'construcción de mazos',
                'description' => 'Un juego de mesa de construcción de mazos (deck-building) es un tipo de juego donde los jugadores comienzan con un mazo pequeño y básico, y mejoran su propia baraja comprando o adquiriendo cartas más poderosas de un mercado central durante la partida. El objetivo es optimizar el mazo para crear combinaciones ("combos") y ganar.',
            ],
            [
                'type' => 'cooperativo',
                'description' => 'Un juego de mesa cooperativo es aquel donde los jugadores unen fuerzas para trabajar en equipo y lograr un objetivo común, ganando o perdiendo juntos contra el propio juego. A diferencia de los juegos competitivos, aquí la meta es colaborar para superar obstáculos, fomentando la comunicación y la interacción social en lugar de la confrontación.',
            ],
            [
                'type' => 'dados',
                'description' => 'Un juego de mesa de dados es aquel que utiliza dados como mecanismo principal para generar azar, incertidumbre y determinar acciones o puntuaciones, generalmente lanzándolos sobre una superficie para obtener combinaciones numéricas o de símbolos. Estos juegos pueden basarse en la suerte, la gestión de riesgos (forzar la suerte) o la estrategia.',
            ],
            [
                'type' => 'escape room',
                'description' => 'Un juego de mesa tipo escape room es una experiencia cooperativa que traslada la emoción de una sala de escape real a la mesa de casa. Los jugadores trabajan en equipo para resolver acertijos, enigmas y rompecabezas ocultos en cartas, libretos o componentes físicos, con el objetivo de cumplir una misión en un tiempo límite, usualmente 60 minutos.',
            ],
            [
                'type' => 'estrategia',
                'description' => 'Un juego de mesa de estrategia es un tipo de juego donde la planificación, la toma de decisiones críticas y la gestión de recursos son fundamentales para ganar, minimizando el azar. Se caracterizan por requerir pensamiento crítico y anticipación de los movimientos del oponente, con reglas a menudo complejas y partidas largas.',
            ],
            [
                'type' => 'eurogame',
                'description' => 'Un eurogame (o juego estilo alemán) es un juego de mesa centrado en la gestión de recursos, la estrategia y la planificación, donde la mecánica prevalece sobre la temática. Suelen evitar la eliminación de jugadores, el conflicto directo y el azar excesivo, enfocándose en la suma de puntos de victoria.',
            ],
            [
                'type' => 'familiar',
                'description' => 'Un juego de mesa familiar es una actividad lúdica diseñada para reunir a personas de diferentes edades (niños, adultos y mayores) en torno a una mesa, fomentando la interacción social, la cooperación y la diversión compartida. Se caracterizan por tener reglas sencillas de aprender, tiempos de juego moderados y un equilibrio entre estrategia, suerte y entretenimiento.',
            ],
            [
                'type' => 'filler',
                'description' => 'Un juego de mesa "filler" (o de relleno) es un título rápido, ligero y de reglas sencillas, diseñado para jugarse en 15-30 minutos. Son ideales para romper el hielo, jugar entre títulos más complejos o en descansos, caracterizándose por un montaje rápido, portabilidad y alta rejugabilidad, siendo accesibles para todo tipo de jugadores.',
            ],
            [
                'type' => 'infantil',
                'description' => 'Un juego de mesa infantil es una actividad lúdica, diseñada con tablero, fichas, cartas o dados, enfocada en el entretenimiento y aprendizaje de los niños. Estimulan habilidades cognitivas (lógica, memoria), motoras y sociales (trabajo en grupo, esperar turno), siendo ideales para el desarrollo integral en entornos escolares o familiares.',
            ],
            [
                'type' => 'investigacion',
                'description' => 'Los juegos de mesa de investigación son títulos cooperativos o competitivos donde los jugadores asumen el papel de detectives para resolver misterios, crímenes o enigmas. Se caracterizan por el análisis de pistas, la lectura narrativa y la deducción lógica, diferenciándose de los escape rooms por su enfoque en la historia y la recopilación de datos.',
            ],
            [
                'type' => 'mayorias',
                'description' => 'Los juegos de mesa de mayorías o influencia (área control) son aquellos donde los jugadores compiten por dominar distintas zonas de un tablero. Gana quien coloca más piezas, fichas o meeples en un área específica para obtener puntos de victoria o beneficios, superando la presencia de los rivales.',
            ],
            [
                'type' => 'narrativo',
                'description' => 'Un juego de mesa narrativo es aquel donde el objetivo principal es vivir y construir una historia, priorizando la trama y la inmersión sobre la mecánica competitiva. Los jugadores toman decisiones como protagonistas que afectan el desarrollo de la aventura, a menudo mediante libros de cuentos, mazos de cartas, aplicaciones o textos extensos.',
            ],
            [
                'type' => 'party',
                'description' => 'Un juego de mesa tipo party (o fiestero) es un juego diseñado para grupos grandes, caracterizado por reglas muy sencillas, corta duración y un alto componente de interacción social, risas y diversión. Están creados para romper el hielo en fiestas, reuniones o sobremesas, siendo accesibles para todo tipo de personas, jueguen habitualmente o no.',
            ],
            [
                'type' => 'roles ocultos',
                'description' => 'Un juego de mesa de roles ocultos es un tipo de juego de deducción social y engaño donde los jugadores reciben identidades o bandos secretos (ej. "buenos" vs "malos") que no deben revelar. El objetivo principal es descubrir la identidad de los demás mientras se miente o engaña para cumplir metas secretas y ganar.',
            ],
            [
                'type' => 'wargame',
                'description' => 'Un wargame (o juego de guerra) es un tipo de juego de mesa de estrategia que simula conflictos bélicos, ya sean históricos (como la Segunda Guerra Mundial) o fantásticos. Los jugadores asumen el papel de comandantes militares, utilizando miniaturas, fichas de cartón o bloques para mover tropas, gestionar suministros y combatir en un mapa, con el fin de superar al rival mediante tácticas superiores.',
            ]
        ]);
    }
}
