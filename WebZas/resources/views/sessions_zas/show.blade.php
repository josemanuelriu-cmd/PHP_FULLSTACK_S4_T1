<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-zas-primary leading-tight">
                🎲 Sesiones ZAS
            </h2>

        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto px-4 py-10">

        <a href="{{ route('sessions_zas.index') }}"
        class="text-zas-primary hover:underline">
            ← Volver al listado
        </a>

        <div class="bg-white border border-zas-primary
                    rounded-2xl p-10 mt-6 shadow-2xl">

            <h2 class="text-4xl font-bold text-zas-primary mb-8">
                {{ $session_zas->date }}
            </h2>

            <div class="grid md:grid-cols-2 gap-8 text-gray-300">
                <div>
                    <p><span class="text-gray-700 font-semibold">⏳ hora inicio-hora final:</span>
                        <span class="text-zas-primary font-semibold">
                            <!-- {{ $session_zas->start_time }} - {{ $session_zas->end_time }} -->
                            {{ \Carbon\Carbon::parse($session_zas->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($session_zas->end_time)->format('H:i') }}
                        </span>
                    </p>

                    <p><span class="text-gray-700 font-semibold">👥 Usuarios máximos:</span>
                        <span class="text-zas-primary font-semibold">{{ $session_zas->max_users }}</span>
                    </p>
                </div>                
            </div>
            <div>
                <p><span class="text-gray-700 font-semibold"> Dirección:</span>
                    <span class="text-zas-primary font-semibold">{{ $session_zas->direction }}</span>
                </p>
            </div>

            <div class="mt-8 border-t border-zas-primary/30 pt-6">
                <h3 class="text-xl font-semibold text-gray-700 mb-3">Mapa</h3>
                //<iframe src="{{ $session_zas->map_url }}" width="100%" height="400" class="rounded-lg border border-zas-primary" allowfullscreen="" loading="lazy"></iframe>
                <iframe src="https://maps.google.com/maps?q={{ $session_zas->latitude ?? '' }},{{  $session_zas->longitude ?? '' }}&z=ZOOM&output=embed"></iframe>
            </div>

            <div class="flex gap-4 mt-10">
                <a href="{{ route('sessions_zas.edit', ['sessions_zas' => $session_zas->id]) }}"
                class="bg-zas-primary px-4 py-2 rounded-lg text-white hover:bg-zas-primaryHover transition">
                    Editar
                </a>

                <form action="{{ route('sessions_zas.destroy', ['sessions_zas' => $session_zas->id]) }}" method="post">
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