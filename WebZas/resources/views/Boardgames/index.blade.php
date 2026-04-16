@php
$user = auth()->user();
$canManageSession = in_array($user->type, ['admin','junta']);
@endphp
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-zas-primary leading-tight">
                🎲 {{ __('messages.Playroom') }}
            </h2>
            @if ($canManageSession)
            <a href="{{ route('boardgames.create') }}"
               class="bg-zas-primary px-5 py-2 rounded-xl text-white font-semibold
                      hover:bg-zas-primaryHover transition shadow-lg">
                + {{ __('messages.Add game') }}
            </a>
            @endif
        </div>
    </x-slot>
    @if(session('success'))
        <div class="alert alert-success bg-green-200 text-green-800 p-3 rounded mb-4" x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 4000)">
            {{ session('success') }}
        </div>
    @endif
    
        <div class="max-w-6xl mx-auto px-4 py-6 border-b border-zas-primary">
            <form method="GET" action="{{ route('boardgames.index') }}" class="flex flex-wrap gap-4 items-end">

                <div class="flex flex-col">
                    <label for="name" class="text-zas-primary font-semibold">
                        {{ __('messages.Name') }}
                    </label>
                    <input type="text" name="name" id="name" value="{{ request('name') }}"
                        class="text-zas-gray border rounded-lg px-3 py-2 w-48 border-zas-primary focus:border-zas-primary focus:ring-zas-primary">
                </div>

                <div class="flex flex-col">
                    <label for="type" class="text-zas-primary font-semibold">
                        {{ __('messages.Type') }}
                    </label>
                    <select name="type" id="type" class="text-zas-gray border rounded-lg px-3 py-2 w-48 border-zas-primary focus:border-zas-primary focus:ring-zas-primary">
                        <option value="">
                            {{ __('messages.All types') }}
                        </option>
                        @foreach($types as $type)
                            <option value="{{ $type->id }}" @selected(request('type') == $type->id)>
                                {{ $type->type }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex flex-col">
                    <label for="players" class="text-zas-primary font-semibold">
                        {{ __('messages.Players') }}
                    </label>
                    <input type="number" name="players" id="players" value="{{ request('players') }}"
                        class="text-zas-gray border rounded-lg px-3 py-2 w-32 border-zas-primary focus:border-zas-primary focus:ring-zas-primary">
                </div>

                <div class="flex flex-col">
                    <label for="age" class="text-zas-primary font-semibold">
                        {{ __('messages.Min age') }}
                    </label>
                    <input type="number" name="age" id="age" value="{{ request('age') }}"
                        class="text-zas-gray border rounded-lg px-3 py-2 w-32 border-zas-primary focus:border-zas-primary focus:ring-zas-primary">
                </div>

                <div class="flex flex-col">
                    <label for="duration" class="text-zas-primary font-semibold">
                        {{ __('messages.Max duration') }}
                    </label>
                    <input type="number" name="duration" id="duration" value="{{ request('duration') }}"
                        class="text-zas-gray border rounded-lg px-3 py-2 w-32 border-zas-primary focus:border-zas-primary focus:ring-zas-primary">
                </div>

                <div class="flex flex-col justify-end">
                    <button type="submit"
                            class="bg-zas-primary px-5 py-2 rounded-lg text-white font-semibold
                                hover:bg-zas-primaryHover transition shadow-lg">
                        {{ __('messages.Filter') }}
                    </button>
                </div>

                @if(request()->hasAny(['name','type','players','age','duration']))
                <div class="flex flex-col">
                    <a href="{{ route('boardgames.index') }}"
                    class="bg-zas-gray px-5 py-2 rounded-lg text-white font-semibold
                            hover:bg-zas-grayHover transition shadow-lg">
                        {{ __('messages.Clean') }}
                    </a>
                </div>
                @endif
            </form>
        </div>


    <div class="max-w-6xl mx-auto px-4 py-10 ">
        @if($boardgames->count())
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($boardgames as $boardgame)
                    <div class="bg-zas-light border border-zas-primary/20
                                rounded-xl p-6 shadow-md
                                hover:shadow-xl hover:border-zas-primary transition">
                        <h3 class="text-xl font-bold text-zas-dark mb-3">
                            {{ $boardgame->name }}
                        </h3>

                        <p class="text-zas-gray mb-2">👥 {{ $boardgame->min_players }} - {{ $boardgame->max_players }} {{ __('messages.Players') }}</p>
                        <p class="text-zas-gray mb-2">🎂 {{ $boardgame->min_age }}+ {{ __('messages.years') }}</p>
                        <p class="text-zas-gray mb-2">⏳ {{ $boardgame->duration }} {{ __('messages.minutes') }}</p>

                        <p class="text-zas-gray mb-4">👑
                            {{ $boardgame->owner?->nickname ?? 'ZAS' }}
                         </p>

                        <a href="{{ route('boardgames.show', $boardgame) }}"
                           class="text-zas-primary font-semibold hover:underline">
                            {{ __('messages.See file') }} →
                        </a>
                    </div>
                @endforeach
            </div>

            <div class="mt-10 text-zas-primary">
                {{ $boardgames->withQueryString()->links() }}
            </div>
        @else
            <p class="text-zas-primary">
                {{ __('messages.There are no games that meet the filters') }}.
            </p>
        @endif
    </div>
</x-app-layout>