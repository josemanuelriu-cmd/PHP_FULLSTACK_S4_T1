<x-guest-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-zas-primary">
            🎲 Club de Juegos ZAS!
        </h2>
    </x-slot>

    <div class="max-w-5xl mx-auto px-4 py-10">
        <div class="bg-white rounded-2xl shadow-xl p-8 mb-8">
            <h1 class="text-3xl font-bold text-zas-primary mb-4">
                Bienvenido al club ZAS
            </h1>
            <p class="text-zas-gray">
                Somos un grupo de aficionados a los juegos de mesa que nos reunimos
                regularmente para jugar, aprender juegos nuevos y compartir buenos momentos.
            </p>
        </div>

        @if($zassession)
            <div class="bg-white rounded-2xl shadow-xl p-8">
                <h2 class="text-2xl font-bold text-zas-primary mb-6">
                    📅 Próxima sesión
                </h2>
                <p class="text-xl font-bold text-zas-primary mb-3">
                    {{ ucfirst(\Carbon\Carbon::parse($zassession->date)->isoFormat('dddd D MMMM YYYY')) }}
                </p>

                @include('zassessions.session')
<!--                
                <p class="text-zas-gray mb-6">
                    👥 {{ $zassession->users->count() }}/{{ $zassession->max_users }} jugadores
                </p>
                <h3 class="text-xl font-semibold text-zas-primary mb-3">
                    Usuarios apuntados
                </h3>
                <ul class="grid grid-cols-2 gap-2 text-zas-gray mb-6">
                    @foreach($zassession->users as $user)
                        <li>
                            {{ $user->nickname }}
                        </li>
                    @endforeach
                </ul>
                <h3 class="text-xl font-semibold text-zas-primary mb-3">
                    Partidas creadas
                </h3>
                @if($zassession->games->count())
                    <ul class="space-y-3">
                    @foreach($zassession->games as $game)
                        <li class="border border-zas-primary/30 rounded-lg p-3">
                            🎲 {{ $game->boardgame->name }}
                            <div class="text-sm text-zas-gray">
                                👤 {{ $game->players->count() }}/{{ $game->max_players }}
                                - {{ $game->start_time }}
                            </div>
                        </li>
                    @endforeach
                    </ul>
                @else
                    <p class="text-gray-400">
                        Aún no hay partidas creadas
                    </p>
                @endif
            </div>
        -->            
        @endif
    </div>
</x-guest-layout>