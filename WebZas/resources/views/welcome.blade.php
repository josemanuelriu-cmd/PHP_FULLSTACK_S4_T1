<x-guest-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-zas-primary">
            🎲 Club de Juegos ZAS!
        </h2>
    </x-slot>

    <div class="max-w-5xl mx-auto px-4 py-10">
        <div class="bg-white rounded-2xl shadow-xl p-8 mb-8">
            <h1 class="text-3xl font-bold text-zas-primary mb-4">
                {{ __('messages.Welcome to ZAS club') }}
            </h1>
            <p class="text-zas-gray">
                {{ __('messages.We are a group of board game enthusiasts who meet regularly to play, learn new games, and share good times') }}
            </p>
        </div>

        @if($zassession)
            <div class="bg-white rounded-2xl shadow-xl p-8">
                <h2 class="text-2xl font-bold text-zas-primary mb-6">
                    📅 {{ __('messages.Next session') }}
                </h2>
                <p class="text-xl font-bold text-zas-primary mb-3">
                    {{ ucfirst(\Carbon\Carbon::parse($zassession->date)->isoFormat('dddd D MMMM YYYY')) }}
                </p>

                @include('zassessions.session')
     
        @endif
    </div>
</x-guest-layout>