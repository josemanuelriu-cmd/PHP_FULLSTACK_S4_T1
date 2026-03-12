<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-zas-primary leading-tight">
                📅 {{ __('Sesiones') }}
            </h2>

        </div>
    </x-slot>

@php
    $user = auth()->user();
    $isJoined = $zassession->users->contains($user->id);
    $isFull = $zassession->users->count() >= $zassession->max_users+1;//añado 1 para poder entrar 1 parsona mas del limite teorico

    $maxSlots = 16;
    $users = $zassession->users->values();
    $slots = collect(range(1,$maxSlots))->map(function($i) use ($users) {
        return $users[$i-1] ?? null;
    });

    $column1 = $slots->slice(0,8);
    $column2 = $slots->slice(8,8);
@endphp    
    <div class="max-w-4xl mx-auto px-4 py-10">

        <a href="{{ route('zassessions.index') }}"
        class="text-zas-primary hover:underline">
            ← Volver al listado
        </a>

        <div class="bg-white border border-zas-primary
                    rounded-2xl p-10 mt-6 shadow-2xl">

            <h3 class="text-4xl font-bold text-zas-primary mb-8">
                {{ ucfirst(\Carbon\Carbon::parse($zassession->date)->isoFormat('dddd D [de] MMMM [de] YYYY')) }}
            </h3>

            <div class="grid md:grid-cols-2 gap-8 text-gray-300">
                <p><span class="text-zas-gray font-semibold">⏰ 
                        {{ \Carbon\Carbon::parse($zassession->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($zassession->end_time)->format('H:i') }}
                    </span>
                </p>
                <?php $activeUsers = $zassession->users->count(); ?>
                <p><span class="<?php if ($activeUsers<15) echo "text-zas-gray"; else echo "text-zas-primary"; ?> font-semibold">👥 {{ $activeUsers }}/{{ $zassession->max_users }}</span>
                    
                </p>
            </div>

            <div class="grid md:grid-cols-2 gap-8 text-gray-300">
                <p><span class="text-zas-gray font-semibold">🏠 {{ $zassession->name }}</span>
                    @if($zassession->event_name)
                        <span class="text-zas-gray font-semibold">{{ $zassession->event_name }}</span>
                    @endif
                </p>

                <p>
                    <span class="text-zas-gray font-semibold">
                        📍 
                        <a href="https://www.google.com/maps?q={{ $zassession->latitude }},{{ $zassession->longitude }}"
                            target="_blank" class="hover:underline">
                            {{ $zassession->direction }}
                        </a>
                    </span>
                </p>
            </div>

            <div class="grid md:grid-cols-2 gap-8 mt-4 border-t border-zas-primary/30 pt-4"> 
                <div>               
                    <h3 class="text-zas-primary font-semibold mb-2">Usuarios apuntados</h3>
                    <div class="grid grid-cols-2 gap-6 text-zas-gray">
                        <ul class="list-inside">
                            @foreach($column1 as $index => $user)
                                <li>
                                    {{ $index+1 }}
                                    @if($user)
                                        @php
                                            $isCurrent = $user->id === auth()->id();
                                        @endphp                                        
                                        @if($isCurrent) 
                                            ⭐ 
                                        @endif
                                        {{ $user->nickname }}                                    
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </li>
                            @endforeach
                        </ul>

                        <ul class="list-inside">
                            @foreach($column2 as $index => $user)
                                <li>
                                    {{ $index+1 }} 
                                    @if($user)
                                        @php
                                            $isCurrent = $user->id === auth()->id();
                                        @endphp                                        
                                        @if($isCurrent) 
                                            ⭐ 
                                        @endif
                                        {{ $user->nickname }}                                    
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div> 
                    <h3 class="text-zas-primary font-semibold">Partidas creadas</h3>
                    @if($zassession->games->count() > 0)
                        <ul class="text-zas-gray space-y-3">
                            @foreach($zassession->games as $game)
                                <a href="{{ route('games.show', [$zassession, $game]) }}" class="cursor-pointer space-y-3"> 
                                    <li class="border border-zas-primary/30 rounded-lg p-3">
                                        <span class="font-semibold">
                                            🎲 {{ $game->boardgame->name }}{{ $game->status==='limited' ? '*':'' }}
                                            - {{ \Carbon\Carbon::parse($game->start_time)->format('H:i') }}                                            
                                        </span>
                                        <div class="text-sm mt-1">
@php
$isGameFull = $game->players->count() >= $game->max_players;
$isGameStarted = $game->status === 'playing';
$isGameClosed = $game->status === 'finished';
@endphp                                            
                                            👤 {{ $game->players->count() }}/{{ $game->max_players }}
                                            @if ($isGameStarted || $isGameClosed) 🔴
                                            @elseif ($isGameFull) 🟠
                                            @else 🟢                                                
                                            @endif
                                            👑 Organiza: {{ $game->host->nickname }}
                                        </div>
                                        <div class="text-sm mt-1">
                                            Jugadores:
                                            @foreach($game->players as $player)
                                                <span class="inline-block mr-2">{{ $player->nickname }},</span>
                                            @endforeach
                                        </div>
                                    </li>
                                </a>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-gray-400">
                            No hay partidas creadas todavía.
                        </p>
                    @endif
                </div>
            </div>

            <div class="flex gap-4 mt-10">                
                <a href="{{ route('zassessions.edit', ['zassessions' => $zassession]) }}"
                class="bg-zas-primary px-4 py-2 rounded-lg text-white hover:bg-zas-primaryHover transition">
                    Editar
                </a>                

                <form action="{{ route('zassessions.destroy', ['zassessions' => $zassession->id]) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            onclick="return confirm('¿Seguro que quieres eliminar esta sesión?')"
                            class="bg-zas-dark px-4 py-2 rounded-lg text-white hover:bg-zas-darkSoft transition">
                        Borrar
                    </button>
                </form>
                @if(!$isJoined && !$isFull)
                    <form method="POST" action="{{ route('zassessions.join', $zassession) }}">
                        @csrf
                        <button type="submit"
                            class="bg-zas-gray px-4 py-2 rounded-lg text-zas-primary hover:bg-zas-primaryhover transition">
                            Apuntarse a la sesión
                        </button>
                    </form>
                @endif
                @if($isJoined)
                    <form method="POST" action="{{ route('zassessions.leave', $zassession) }}">
                        @csrf
                        @method('DELETE')
                        <button class="bg-zas-gray px-4 py-2 rounded-lg text-zas-primary hover:bg-zas-primaryhover transition">
                            Borrarse de la sessión
                        </button>
                    </form>
                @endif
                <a href="{{ route('games.create', $zassession) }}"
                    class="bg-zas-gray px-4 py-2 rounded-lg text-zas-primary hover:bg-zas-primaryhover transition">
                    Crear partida
                </a>            

            </div>
            @if(session('success'))
                <div class="bg-green-200 text-green-800 p-3 rounded mb-4 mt-4">
                    {{ session('success') }}
                </div>
            @endif

        </div>

    </div>
</x-app-layout>