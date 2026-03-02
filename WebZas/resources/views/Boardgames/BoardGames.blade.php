@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-10">

    <div class="flex justify-between items-center mb-8">
        <h2 class="text-4xl font-bold text-zas-primary tracking-wide">
            🎲 Ludoteca ZAS
        </h2>

        <a href="{{ route('boardgames.create') }}"
           class="bg-zas-primary px-5 py-2 rounded-lg text-white font-semibold
                  hover:bg-zas-primaryHover transition shadow-lg">
            + Añadir juego
        </a>
    </div>

    @if($boardgames->count())
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($boardgames as $boardgame)
                <div class="bg-white border border-zas-primary/20
            rounded-xl p-6 shadow-md
            hover:shadow-xl hover:border-zas-primary transition">

                    <h3 class="text-xl font-bold text-gray-400 mb-3">
                        {{ $boardgame->name }}
                    </h3>

                    <p class="text-gray-400 mb-4">
                        👥 {{ $boardgame->min_players }} - {{ $boardgame->max_players }} jugadores
                    </p>
                    <p class="text-gray-400 mb-4">
                        🎂 {{ $boardgame->min_age }}+ años
                    </p>
                    <p class="text-gray-400 mb-4">
                        ⏳ {{ $boardgame->duration }} minutos
                    </p>

                    <a href="{{route('boardgames.show', $boardgame) }}"
                       class="text-zas-primary font-semibold hover:underline">
                        Ver ficha →
                    </a>
                </div>
            @endforeach
        </div>

        <div class="mt-10">
            {{ $boardgames->links() }}
        </div>
    @else
        <p class="text-gray-400">Aún no hay juegos registrados.</p>
    @endif

</div>
@endsection