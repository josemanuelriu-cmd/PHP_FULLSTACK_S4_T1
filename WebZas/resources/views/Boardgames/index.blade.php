@php
$user = auth()->user();
$canManageSession = in_array($user->type, ['admin','junta']);
@endphp
<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap justify-between items-center gap-2">
            <h2 class="font-semibold text-2xl text-zas-primary leading-tight">
                🎲 {{ __('messages.Playroom') }}
            </h2>
            @if ($canManageSession)
            <a href="{{ route('boardgames.create') }}"
               class="bg-zas-primary px-4 py-2 rounded-xl text-white font-semibold text-sm
                      hover:bg-zas-primaryHover transition shadow-lg shrink-0">
                + {{ __('messages.Add game') }}
            </a>
            @endif
        </div>
    </x-slot>

    @if(session('success'))
        <div class="alert alert-success bg-green-200 text-green-800 p-3 rounded mb-4 mx-4"
             x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 4000)">
            {{ session('success') }}
        </div>
    @endif

    {{-- Filter bar --}}
    <div class="max-w-6xl mx-auto px-4 py-6 border-b border-zas-primary">
        <form method="GET" action="{{ route('boardgames.index') }}">
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3 items-end">

                <div class="flex flex-col col-span-2 sm:col-span-1 lg:col-span-2">
                    <label for="name" class="text-zas-primary font-semibold text-sm mb-1">
                        {{ __('messages.Name') }}
                    </label>
                    <input type="text" name="name" id="name" value="{{ request('name') }}"
                        class="text-zas-gray border rounded-lg px-3 py-2 w-full border-zas-primary focus:border-zas-primary focus:ring-zas-primary text-sm">
                </div>

                <div class="flex flex-col">
                    <label for="type" class="text-zas-primary font-semibold text-sm mb-1">
                        {{ __('messages.Type') }}
                    </label>
                    <select name="type" id="type" class="text-zas-gray border rounded-lg px-3 py-2 w-full border-zas-primary focus:border-zas-primary focus:ring-zas-primary text-sm">
                        <option value="">{{ __('messages.All types') }}</option>
                        @foreach($types as $type)
                            <option value="{{ $type->id }}" @selected(request('type') == $type->id)>
                                {{ $type->type }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex flex-col">
                    <label for="players" class="text-zas-primary font-semibold text-sm mb-1">
                        {{ __('messages.Players') }}
                    </label>
                    <input type="number" name="players" id="players" value="{{ request('players') }}"
                        class="text-zas-gray border rounded-lg px-3 py-2 w-full border-zas-primary focus:border-zas-primary focus:ring-zas-primary text-sm">
                </div>

                <div class="flex flex-col">
                    <label for="age" class="text-zas-primary font-semibold text-sm mb-1">
                        {{ __('messages.Min age') }}
                    </label>
                    <input type="number" name="age" id="age" value="{{ request('age') }}"
                        class="text-zas-gray border rounded-lg px-3 py-2 w-full border-zas-primary focus:border-zas-primary focus:ring-zas-primary text-sm">
                </div>

                <div class="flex flex-col">
                    <label for="duration" class="text-zas-primary font-semibold text-sm mb-1">
                        {{ __('messages.Max duration') }}
                    </label>
                    <input type="number" name="duration" id="duration" value="{{ request('duration') }}"
                        class="text-zas-gray border rounded-lg px-3 py-2 w-full border-zas-primary focus:border-zas-primary focus:ring-zas-primary text-sm">
                </div>
            </div>

            <div class="flex flex-wrap gap-2 mt-3">
                <button type="submit"
                        class="bg-zas-primary px-5 py-2 rounded-lg text-white font-semibold text-sm
                            hover:bg-zas-primaryHover transition shadow-lg">
                    {{ __('messages.Filter') }}
                </button>
                @if(request()->hasAny(['name','type','players','age','duration']))
                <a href="{{ route('boardgames.index') }}"
                   class="bg-zas-gray px-5 py-2 rounded-lg text-white font-semibold text-sm
                           hover:opacity-80 transition shadow-lg">
                    {{ __('messages.Clean') }}
                </a>
                @endif
            </div>
        </form>
    </div>

    {{-- Games grid --}}
    <div class="max-w-6xl mx-auto px-4 py-8">
        @if($boardgames->count())
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($boardgames as $boardgame)
                    <div class="bg-zas-light border border-zas-primary/20
                                rounded-xl p-5 shadow-md
                                hover:shadow-xl hover:border-zas-primary transition">
                        <h3 class="text-lg font-bold text-zas-dark mb-3 leading-tight">
                            {{ $boardgame->name }}
                        </h3>

                        <p class="text-zas-gray text-sm mb-1.5">👥 {{ $boardgame->min_players }} - {{ $boardgame->max_players }} {{ __('messages.Players') }}</p>
                        <p class="text-zas-gray text-sm mb-1.5">🎂 {{ $boardgame->min_age }}+ {{ __('messages.years') }}</p>
                        <p class="text-zas-gray text-sm mb-1.5">⏳ {{ $boardgame->duration }} {{ __('messages.minutes') }}</p>
                        <p class="text-zas-gray text-sm mb-4">👑 {{ $boardgame->owner?->nickname ?? 'ZAS' }}</p>

                        <a href="{{ route('boardgames.show', $boardgame) }}"
                           class="text-zas-primary font-semibold text-sm hover:underline">
                            {{ __('messages.See file') }} →
                        </a>
                    </div>
                @endforeach
            </div>

            <div class="mt-8 text-zas-primary">
                {{ $boardgames->withQueryString()->links() }}
            </div>
        @else
            <p class="text-zas-primary">
                {{ __('messages.There are no games that meet the filters') }}.
            </p>
        @endif
    </div>
</x-app-layout>
