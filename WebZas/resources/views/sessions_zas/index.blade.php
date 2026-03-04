<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-zas-primary leading-tight">
                🎲 ZAS
            </h2>

            <a href="{{ route('sessions_zas.create') }}"
               class="bg-zas-primary px-5 py-2 rounded-xl text-white font-semibold
                      hover:bg-zas-primaryHover transition shadow-lg">
                + Añadir sesión
            </a>
        </div>
    </x-slot>

    <div class="max-w-6xl mx-auto px-4 py-10 ">
        @if($sessions_zas->count())
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($sessions_zas as $session_zas)
                    <div class="bg-zas-light border border-zas-primary/20
                                rounded-xl p-6 shadow-md
                                hover:shadow-xl hover:border-zas-primary transition">
                        <h3 class="text-xl font-bold text-zas-dark mb-3">
                            {{ $session_zas->date }}
                        </h3>


                        <a href="{{ route('sessions_zas.show', ['sessions_zas' => $session_zas->id]) }}"
                           class="text-zas-primary font-semibold hover:underline">
                            Ver ficha →
                        </a>
                    </div>
                @endforeach
            </div>

            <div class="mt-10">
                {{ $sessions_zas->links() }}
            </div>
        @else
            <p class="text-zas-gray">Aún no hay sesiones registradas.</p>
        @endif
    </div>
</x-app-layout>