@php
    $boardgame = $boardgame ?? null;
    $user = $user ?? null;
    $game = $game ?? null;
@endphp


<div class="grid md:grid-cols-2 gap-4 my-4">
    <div>
        <label class="block text-gray-700 font-semibold mb-2">{{ __('messages.Game') }} - {{ __('messages.Max players') }}</label>
        <select name="boardgame_id" class="border-zas-primary border rounded-lg shadow-sm focus:ring-zas-primary focus:border-zas-primary pl-2 text-zas-primary">
            @foreach($boardgames as $boardgame)
                <option value="{{ $boardgame->id }}" 
                    {{ old('boardgame_id', $game?->boardgame_id) == $boardgame->id ? 'selected' : '' }}>
                    {{ $boardgame->name }} - {{ $boardgame->max_players}}
                </option>
            @endforeach
        </select>

        <div class="my-4">
            <label class="block text-gray-700 font-semibold mb-2">{{ __('messages.Type of game') }}</label>
            <select name="status" class="border-zas-primary border rounded-lg shadow-sm focus:ring-zas-primary focus:border-zas-primary pl-2 text-zas-primary">
                <option value="open" {{ old('status', $game?->status ?? 'open') == 'open' ? 'selected' : '' }} class="text-zas-primary">{{ __('messages.Open') }}</option>
                <option value="limited" {{ old('status', $game?->status ?? 'limited') == 'limited' ? 'selected' : '' }} class="text-zas-primary">{{ __('messages.Members only') }}</option>
            </select>
        </div>
       
        <div class="my-4">
            <label class="block text-gray-700 font-semibold mb-2">{{ __('messages.Start time') }}</label>
            <input type="time" name="start_time" 
                value="{{ old('start_time', $game?->start_time) }}"
                class="rounded border-zas-primary text-zas-primary shadow-sm focus:ring-zas-primary">
        </div>
        <div class="my-4">                            
            <input type="checkbox" name="necesary_know_how"  {{ old('necesary_know_how', $game?->necesary_know_how) ? 'checked' : '' }}
                class="rounded border-zas-primary text-zas-primary shadow-sm focus:ring-zas-primary" value="1">
            <span>{{ __('messages.Must know how to play') }}</span>
        </div>
    </div>

    <div>
        <label class="block text-gray-700 font-semibold mb-2">{{ __('messages.Add players') }}</label>
        <lu class="text-zas-primary list-inside">
            @foreach($users as $user)
                <li class="list-none">
                    <input type="checkbox" name="players[]" value="{{ $user->id }}"
                        class="rounded border-zas-primary text-zas-primary shadow-sm focus:ring-zas-primary"
                         {{ collect(old('players', $game?->players?->pluck('id')->toArray()))
                                ->contains($user->id)
                                ? 'checked'
                                : ''
                        }}>
                    {{ $user->nickname }}
                </li>
            @endforeach
        </lu>

    </div>
</div>