@php
$user = auth()->user();
$canManageSession = in_array($user->type, ['admin','junta']);
@endphp
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-zas-primary leading-tight">
                📅 {{ __('messages.Sessions') }}
            </h2>

            <form method="GET" action="{{ route('zassessions.index') }}" class="mb-4">
                <label class="flex items-center gap-2 text-zas-primary">
                    <input type="checkbox"
                        name="show_past"
                        value="1"
                        
                        onchange="this.form.submit()"
                        {{ $showPast ? 'checked' : '' }}>
                    {{ __('messages.Show past sessions') }}
                </label>
            </form>
            
            @if ($canManageSession)
                <a href="{{ route('zassessions.create') }}"
                class="bg-zas-primary px-5 py-2 rounded-xl text-white font-semibold
                        hover:bg-zas-primaryHover transition shadow-lg">
                    + {{ __('messages.Add session') }}
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
                            {{ __('messages.See file') }} →
                        </a>
                    </div>
                @endforeach
            </div>

            <div class="mt-10">
                {{ $zassessions->withQueryString()->links() }}
            </div>
        @else
            <p class="text-zas-gray">{{ __('messages.There are no sessions registered yet') }}.</p>
        @endif
    </div>
</x-app-layout>