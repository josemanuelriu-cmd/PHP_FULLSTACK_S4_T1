@php
    $user = auth()->user();
    if ($user)
        $isJoined = $zassession->users->contains($user->id);
    else {
        $isJoined = false;
    }
    $isFull = $zassession->users->count() >= $zassession->max_users+1;//añado 1 para poder entrar 1 parsona mas del limite teorico

    $maxSlots = 16;
    $users = $zassession->users->values();
    $slots = collect(range(1,$maxSlots))->map(function($i) use ($users) {
        return $users[$i-1] ?? null;
    });

    $column1 = $slots->slice(0,8);
    $column2 = $slots->slice(8,8);
@endphp 
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
        <h3 class="text-zas-primary font-semibold mb-2">{{ __('messages.Users signed up') }}</h3>
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
        <h3 class="text-zas-primary font-semibold">{{ __('messages.Created games') }}</h3>
        @if($zassession->games->count() > 0)
            <ul class="text-zas-gray space-y-3">
                @foreach($zassession->games as $game)
                    @php
                        $isGameFull = $game->players->count() >= $game->max_players;
                        $isGameStarted = $game->status === 'playing';
                        $isGameClosed = $game->status === 'finished';
                    @endphp 
                    <a href="{{ route('games.show', [$zassession, $game]) }}" class="cursor-pointer space-y-3"> 
                        <li class="border border-zas-primary/30 rounded-lg p-3">
                            <span class="font-semibold">
                                🎲 {{ $game->boardgame->name }}{{ $game->status==='limited' ? '*':'' }}
                                - {{ \Carbon\Carbon::parse($game->start_time)->format('H:i') }}                                            
                            </span>
                            <div class="text-sm mt-1">
                                           
                                👤 {{ $game->players->count() }}/{{ $game->max_players }}
                                @if ($isGameStarted || $isGameClosed) 🔴
                                @elseif ($isGameFull) 🟠
                                @else 🟢                                                
                                @endif
                                👑 {{ __('messages.Organize') }}: {{ $game->host->nickname }}
                            </div>
                            <div class="text-sm mt-1">
                                {{ __('messages.Players') }}:
                                @foreach($game->players as $player)
                                    <span class="inline-block mr-1">{{ $player->nickname }}@if(!$loop->last),@endif</span>
                                @endforeach
                            </div>
                        </li>
                    </a>
                @endforeach
            </ul>
        @else
            <p class="text-gray-400">
                {{ __('messages.No games have been created yet') }}
            </p>
        @endif
    </div>
</div>