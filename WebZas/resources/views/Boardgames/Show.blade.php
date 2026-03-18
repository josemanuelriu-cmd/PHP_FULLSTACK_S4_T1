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

        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto px-4 py-10">

        <a href="{{ route('boardgames.index') }}"
        class="text-zas-primary hover:underline">
            ← {{ __('messages.Return to list') }}
        </a>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white border border-zas-primary
                    rounded-2xl p-10 mt-6 shadow-2xl">

            <h2 class="text-4xl font-bold text-zas-primary mb-8">
                {{ $boardgame->name }}
            </h2>

            <div class="grid md:grid-cols-2 gap-8 text-gray-300">
                <div>
                    <p><span class="text-gray-700 font-semibold">
                        👥 {{ __('messages.Players') }}:
                    </span>
                        <span class="text-zas-primary font-semibold">{{ $boardgame->min_players }} - {{ $boardgame->max_players }}</span>
                    </p>

                    <p><span class="text-gray-700 font-semibold">
                        🎂 {{ __('messages.Min age') }}:
                    </span>
                        <span class="text-zas-primary font-semibold">{{ $boardgame->min_age }}+</span>
                    </p>
                </div>

                <div>
                    <p><span class="text-gray-700 font-semibold">
                        ⏳ {{ __('messages.Duration') }}:
                    </span>
                        <span class="text-zas-primary font-semibold">
                            {{ $boardgame->duration }} {{ __('messages.minutes') }}
                        </span>
                    </p>
                    <p><span class="text-gray-700 font-semibold">
                        🧮 {{ __('messages.Types') }}:
                    </span>
                    <span class="text-zas-primary font-semibold">
                        @foreach($boardgame->types as $type)
                            {{ $type->type }}@if(!$loop->last), @endif
                        @endforeach
                    </span>
                </p>
                </div>
            </div>            

            <div class="mt-8 border-t border-zas-primary/30 pt-6">
                <h3 class="text-xl font-semibold text-gray-700 mb-3">
                    {{ __('messages.Description') }}
                </h3>
                <p class="text-gray-400 leading-relaxed">
                    <span class="text-zas-primary font-semibold">{{ $boardgame->description }}</span>
                </p>
            </div>

            @if ($canManageSession)
                <div class="flex gap-4 mt-10">
                    <a href="{{ route('boardgames.edit', $boardgame) }}"
                    class="bg-zas-primary px-4 py-2 rounded-lg text-white hover:bg-zas-primaryHover transition">
                        {{ __('messages.Edit') }}
                    </a>
                    <form action="{{ route('boardgames.destroy', $boardgame) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                onclick="return confirm('{{ __('messages.Are you sure you want to delete this boardgame?') }}')"
                                class="bg-zas-dark px-4 py-2 rounded-lg text-white hover:bg-zas-darkSoft transition">
                            {{ __('messages.Delete') }}
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>