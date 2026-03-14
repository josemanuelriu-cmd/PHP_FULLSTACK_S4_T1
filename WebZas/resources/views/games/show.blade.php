<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-zas-primary leading-tight">
                🎲 {{ __('Sesiones') }}
            </h2>

        </div>
    </x-slot>
@php
    $user = auth()->user();
    $isJoined = $game->players->contains('id', $user->id);
    $isFull = $game->players->count() >= $game->max_players;
    $isOpen = $game->status === 'open';
    $isLimited = $game->status === 'limited';
    $isHost = $game->host_user_id === $user->id;
    $isAdmin = $user->type === 'admin';

@endphp

    <div class="max-w-4xl mx-auto px-4 py-8">

        <a href="{{ route('zassessions.show', $zassession) }}"
        class="text-zas-primary hover:underline">
            ← Volver a la sesión
        </a>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white border border-zas-primary
                    rounded-2xl p-10 mt-4 shadow-2xl">
            <h2 class="text-3xl font-bold text-zas-primary mb-4">
                📅 {{ $zassession->name }} - {{ ucfirst(\Carbon\Carbon::parse($zassession->date)->isoFormat('dddd D [de] MMMM [de] YYYY')) }}
            </h2>
            <div class="grid md:grid-cols-3 gap-4">
                <div class="col-span-2">
                    <h3 class="text-2xl font-bold text-zas-gray mb-4">
                        🎲 {{ $game->boardgame->name }} @if ($isLimited) - Solo soci@s @endif
                    </h3>

                    <h3 class="text-2xl font-bold text-zas-gray mb-4">
                        👑 {{ $game->host->nickname}}
                    </h3>

                    <h3 class="text-2xl font-bold text-zas-gray mb-4">
                        ⏰ <span class="text-zas-gray">{{ \Carbon\Carbon::parse($game->start_time)->format('H:i') }} </span>- 
                        @if (($isOpen || $isLimited) && !$isFull) 
                            <span class="text-green-500">partida abierta</span>
                        @elseif ($isOpen && $isFull)
                            <span class="text-orange-500">partida llena</span>
                        @else
                            <span class="text-red-500">partida cerrada</span>
                        @endif
                    </h3>
                    
                    <h3 class="text-2xl font-bold mb-4 text-zas-gray">👥 <span class="text-zas-gray">{{ $game->players->count() }}/{{ $game->max_players }} </span> -
                        @foreach ($game->players as $player)
                            {{ $player->nickname }}@if(!$loop->last), @endif
                        @endforeach
                    </h3>
                    <h3 class="text-2xl font-bold mb-8 text-zas-gray">
                        🤓 <span class="{{ $game->necesary_know_how ? 'text-red-500' : 'text-zas-gray' }}"> {{ $game->necesary_know_how ? 'N' : 'No es n' }}ecesario saber jugar </span>
                    </h3>
                </div>
                <div class="grid md:grid-rows-2 gap-8">
                    
                    <div>
                        @if(!$isJoined && !$isFull && $isOpen)
                            <form method="POST" action="{{ route('games.join', [$zassession, $game]) }}">
                                @csrf
                                <button type="submit"
                                    class="bg-zas-gray px-4 py-2 rounded-lg text-zas-primary hover:bg-zas-primaryhover transition">
                                    Apuntarse a la partida
                                </button>
                            </form>
                        @endif
                    </div>
                    <div>
                        @if($isJoined && $isOpen)
                            <form method="POST" action="{{ route('games.leave', [$zassession, $game]) }}">
                                @csrf
                                @method('DELETE')
                                <button class="bg-zas-gray px-4 py-2 rounded-lg text-zas-primary hover:bg-zas-primaryhover transition">
                                    Borrarse de la partida
                                </button>
                            </form>
                        @endif
                    </div>
            </div>
                </div>

            <div class="grid md:grid-cols-4 gap-2">
                <div>
                    <!-- solo el host y el admin pueden editar una partida -->
                    @if ($isHost || $isAdmin)
                        <a href="{{ route('games.edit', [$zassession,$game]) }}"
                        class="bg-zas-primary px-4 py-2 rounded-lg text-white hover:bg-zas-primaryHover transition">
                            Editar partida
                        </a>
                    @endif
                </div>
                <div>
                    <!-- solo el host y el admin pueden borrar una partida -->
                    @if ($isHost || $isAdmin)
                        <form method="POST" action="{{ route('games.destroy', [$zassession,$game]) }}">
                        @csrf
                        @method('DELETE')

                        <button type="submit"
                            onclick="return confirm('¿Seguro que quieres borrar esta partida?')"
                            class="bg-zas-primary px-4 py-2 rounded-lg text-white hover:bg-zas-primaryHover transition">
                            Borrar partida
                        </button>
                    </form>
                    @endif
                </div>
                <div>
                    <!-- solo el host y el admin pueden cerrar una partida -->
                    @if (($isHost || $isAdmin) && $isOpen)
                        <a href="{{ route('games.close', [$zassession,$game]) }}"
                        class="bg-zas-primary px-4 py-2 rounded-lg text-white hover:bg-zas-primaryHover transition">
                            Cerrar partida
                        </a>
                    @endif
                </div>
                <div>
                    <!-- solo el host y el admin pueden reabrir una partida -->
                    @if (($isHost || $isAdmin) && !$isOpen)
                        <a href="{{ route('games.reopen', [$zassession,$game]) }}"
                        class="bg-zas-primary px-4 py-2 rounded-lg text-white hover:bg-zas-primaryHover transition">
                            Reabrir partida
                        </a>
                    @endif
                </div>
            </div>
            

        </div>
    </div>
</x-app-layout>