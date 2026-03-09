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
    $isFull = $zassession->users->count() >= $zassession->max_users;
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
                <p><span class="text-zas-gray font-semibold">👥 {{ $zassession->users->count() }}/{{ $zassession->max_users }}</span>
                    
                </p>
            </div>

            <div class="grid md:grid-cols-2 gap-8 text-gray-300">
                <p><span class="text-zas-gray font-semibold">🏠 {{ $zassession->name }}</span>
                    @if($zassession->event_name)
                        <span class="text-zas-gray font-semibold">{{ $zassession->event_name }}</span>
                    @endif
                </p>

                <p><span class="text-zas-gray font-semibold">📍 {{ $zassession->direction }}</span>
                </p>
            </div>

            <div class="grid md:grid-cols-2 gap-8 mt-8 border-t border-zas-primary/30 pt-6">
                <div class="">
                    <iframe src="https://maps.google.com/maps?q={{ $zassession->latitude ?? '' }},{{  $zassession->longitude ?? '' }}&z=ZOOM&output=embed"></iframe>
                </div>
                <div> <h3 class="text-zas-primary font-semibold"> Usuarios apuntados</h3>
                    <ul class="text-zas-gray">
                    @foreach($zassession->users as $user)
                        <li>{{ $user->nickname }} </li>
                    @endforeach
                    </ul>
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

            </div>
            @if(session('success'))
                <div class="bg-green-200 text-green-800 p-3 rounded mb-4 mt-4">
                    {{ session('success') }}
                </div>
            @endif

        </div>

    </div>
</x-app-layout>