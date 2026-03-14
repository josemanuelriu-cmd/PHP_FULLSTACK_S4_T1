@php
$user = auth()->user();
$canManageSession = in_array($user->type, ['admin','junta']);
@endphp
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-zas-primary leading-tight">
                📅 {{ __('Sesiones') }}
            </h2>
            @if ($canManageSession)
                <a href="{{ route('zassessions.create') }}"
                class="bg-zas-primary px-5 py-2 rounded-xl text-white font-semibold
                        hover:bg-zas-primaryHover transition shadow-lg">
                    + Añadir sesión
                </a>
            @endif
        </div>
    </x-slot>

    <div class="max-w-6xl mx-auto px-4 py-10 ">
        @if($zassessions->count())
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($zassessions as $session)
                    <div class="bg-zas-light border border-zas-primary/20
                                rounded-xl p-6 shadow-md
                                hover:shadow-xl hover:border-zas-primary transition">
                        <h3 class="text-xl font-bold text-zas-primary mb-3">
                            {{ ucfirst(\Carbon\Carbon::parse($session->date)->isoFormat('dddd D [de] MMMM [de] YYYY')) }}
                        </h3>

                        <p class="text-zas-gray mb-4">
                            <span class="font-semibold">⏰
                                {{ \Carbon\Carbon::parse($session->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($session->end_time)->format('H:i') }}
                            </span>
                        </p>
                        <p class="text-zas-gray mb-4">
                            <span class=" font-semibold">🏠 {{ $session->name }}</span>
                            @if($session->event_name)
                                <span class=" font-semibold"> - {{ $session->event_name }}</span>
                            @endif
                        </p>

                        <p class="text-zas-gray mb-4">
                            <span class=" font-semibold">📍{{ $session->direction }}</span>
                        </p>

                        <a href="{{ route('zassessions.show', $session) }}"
                           class="text-zas-primary font-semibold hover:underline">
                            Ver ficha →
                        </a>
                    </div>
                @endforeach
            </div>

            <div class="mt-10">
                {{ $zassessions->links() }}
            </div>
        @else
            <p class="text-zas-gray">Aún no hay sesiones registradas.</p>
        @endif
    </div>
</x-app-layout>