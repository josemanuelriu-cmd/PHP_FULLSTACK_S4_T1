@php
$user = auth()->user();
$isJoined = $zassession->users->contains($user->id);
$isFull = $zassession->users->count() >= $zassession->max_users+1;//añado 1 para poder entrar 1 parsona mas del limite teorico
$canManageSession = in_array($user->type, ['admin','junta']);
$canCreateGame = in_array($user->type, ['admin','junta','partner']);
@endphp
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-zas-primary leading-tight">
                📅 {{ __('messages.Sessions') }}
            </h2>

        </div>
    </x-slot>

   
    <div class="max-w-4xl mx-auto px-4 py-10">

        <a href="{{ route('zassessions.index') }}"
        class="text-zas-primary hover:underline">
            ← {{ __('messages.Return to list') }}
        </a>

        <div class="bg-white border border-zas-primary
                    rounded-2xl p-10 mt-6 shadow-2xl">

            <h3 class="text-4xl font-bold text-zas-primary mb-8">
                {{ ucfirst(\Carbon\Carbon::parse($zassession->date)->isoFormat('dddd D [de] MMMM [de] YYYY')) }}
            </h3>

            @include('zassessions.session')

            <div class="flex gap-4 mt-10">
                @if($canManageSession)
                    <a href="{{ route('zassessions.edit', ['zassessions' => $zassession]) }}"
                    class="bg-zas-primary px-4 py-2 rounded-lg text-white hover:bg-zas-primaryHover transition">
                        {{ __('messages.Edit') }}
                    </a>                

                    <form action="{{ route('zassessions.destroy', ['zassessions' => $zassession->id]) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                onclick="return confirm('{{ __('messages.Are you sure you want to delete this session?')"
                                class="bg-zas-dark px-4 py-2 rounded-lg text-white hover:bg-zas-darkSoft transition">
                            {{ __('messages.Delete') }}
                        </button>
                    </form>
                @endif
                @if(!$isJoined && !$isFull)
                    <form method="POST" action="{{ route('zassessions.join', $zassession) }}">
                        @csrf
                        <button type="submit"
                            class="bg-zas-gray px-4 py-2 rounded-lg text-zas-primary hover:bg-zas-primaryhover transition">
                            {{ __('messages.Join to the session') }}
                        </button>
                    </form>
                @endif
                @if($isJoined)
                    <form method="POST" action="{{ route('zassessions.leave', $zassession) }}">
                        @csrf
                        @method('DELETE')
                        <button class="bg-zas-gray px-4 py-2 rounded-lg text-zas-primary hover:bg-zas-primaryhover transition">
                            {{ __('messages.Delete from the session') }}
                        </button>
                    </form>
                @endif
                @if($canCreateGame)
                    <a href="{{ route('games.create', $zassession) }}"
                        class="bg-zas-gray px-4 py-2 rounded-lg text-zas-primary hover:bg-zas-primaryhover transition">
                        {{ __('messages.Create game') }}
                    </a>
                @endif

            </div>
            @if(session('success'))
                <div class="bg-green-200 text-green-800 p-3 rounded mb-4 mt-4">
                    {{ session('success') }}
                </div>
            @endif

        </div>

    </div>
</x-app-layout>