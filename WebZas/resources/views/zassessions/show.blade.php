<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-zas-primary leading-tight">
                📅 {{ __('Sesiones') }}
            </h2>

        </div>
    </x-slot>

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
                <p><span class="text-zas-gray font-semibold">👥 {{ $zassession->max_users }}</span>
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

            <div class="mt-8 border-t border-zas-primary/30 pt-6">
                <iframe src="https://maps.google.com/maps?q={{ $zassession->latitude ?? '' }},{{  $zassession->longitude ?? '' }}"></iframe>
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
                
            </div>

        </div>

    </div>
</x-app-layout>