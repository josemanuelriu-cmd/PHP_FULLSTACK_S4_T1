<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-zas-primary leading-tight">
                🎲 {{ __('messages.Sessions') }}
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
    $isGuest = $user->type === 'guest';
    //$isUserJoined lo creo en el controlador

@endphp

    <div class="max-w-4xl mx-auto px-4 py-8">

        <a href="{{ route('zassessions.show', $zassession) }}"
        class="text-zas-primary hover:underline">
            ← {{ __('messages.Return to session') }}
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
                        🎲 {{ $game->boardgame->name }} @if ($isLimited) - {{ __('messages.Members only') }} @endif
                    </h3>

                    <h3 class="text-2xl font-bold text-zas-gray mb-4">
                        👑 {{ $game->host->nickname}}
                    </h3>

                    <h3 class="text-2xl font-bold text-zas-gray mb-4">
                        ⏰ <span class="text-zas-gray">{{ \Carbon\Carbon::parse($game->start_time)->format('H:i') }} </span>- 
                        @if (($isOpen || $isLimited) && !$isFull) 
                            <span class="text-green-500">{{ __('messages.game open') }}</span>
                        @elseif ($isOpen && $isFull)
                            <span class="text-orange-500">{{ __('messages.game full') }}</span>
                        @else
                            <span class="text-red-500">{{ __('messages.game closed') }}</span>
                        @endif
                    </h3>
                    
                    <h3 class="text-2xl font-bold mb-4 text-zas-gray">👥 <span class="text-zas-gray">{{ $game->players->count() }}/{{ $game->max_players }} </span> -
                        @foreach ($game->players as $player)
                            {{ $player->nickname }}@if(!$loop->last), @endif
                        @endforeach
                    </h3>
                    <h3 class="text-2xl font-bold mb-8 text-zas-gray">
                        🤓 <span class="{{ $game->necesary_know_how ? 'text-red-500' : 'text-zas-gray' }}"> {{ $game->necesary_know_how ? '' : 'Not is ' }}{{ __('messages.necessary know how to play') }} </span>
                    </h3>
                </div>
                <div class="grid md:grid-rows-2 gap-8">
                    
                    <div>
                        <!--  No esta apuntado a la partida, no esta la partida llena, esta apuntado a la session, es una partida abierta o es limitada pero no es un invitado -->
                        @if(!$isJoined && !$isFull && $isUserJoined && ($isOpen || ($isLimited && !$isGuest)))
                            <form method="POST" action="{{ route('games.join', [$zassession, $game]) }}">
                                @csrf
                                <button type="submit"
                                    class="bg-zas-gray px-4 py-2 rounded-lg text-zas-primary hover:bg-zas-primaryhover transition">
                                    {{ __('messages.Sign up for the game') }}
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
                                    {{ __('messages.Delete yourself from the game') }}
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
                            {{ __('messages.Edit game') }}
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
                            {{ __('messages.Delete game') }}
                        </button>
                    </form>
                    @endif
                </div>
                <div>
                    <!-- solo el host y el admin pueden cerrar una partida -->
                    @if (($isHost || $isAdmin) && $isOpen)
                        <a href="{{ route('games.close', [$zassession,$game]) }}"
                        class="bg-zas-primary px-4 py-2 rounded-lg text-white hover:bg-zas-primaryHover transition">
                            {{ __('messages.Close game') }}
                        </a>
                    @endif
                </div>
                <div>
                    <!-- solo el host y el admin pueden reabrir una partida -->
                    @if (($isHost || $isAdmin) && !$isOpen)
                        <a href="{{ route('games.reopen', [$zassession,$game]) }}"
                        class="bg-zas-primary px-4 py-2 rounded-lg text-white hover:bg-zas-primaryHover transition">
                            {{ __('messages.Reopen game') }}
                        </a>
                    @endif
                </div>
            </div>
            

        </div>
    </div>
</x-app-layout>