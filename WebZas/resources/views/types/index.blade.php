<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-zas-primary leading-tight">
                🎲 ZAS
            </h2>

            <a href="{{ route('types.create') }}"
               class="bg-zas-primary px-5 py-2 rounded-xl text-white font-semibold
                      hover:bg-zas-primaryHover transition shadow-lg">
                + Añadir tipo
            </a>
        </div>
    </x-slot>

    <div class="max-w-6xl mx-auto px-4 py-10 ">
        @if($types->count())
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($types as $type)
                    <div class="bg-zas-light border border-zas-primary/20
                                rounded-xl p-6 shadow-md
                                hover:shadow-xl hover:border-zas-primary transition">
                        <h3 class="text-xl font-bold text-zas-dark mb-3">
                            {{ $type->type }}
                        </h3>


                        <a href="{{ route('types.show', $type) }}"
                           class="text-zas-primary font-semibold hover:underline">
                            Ver ficha →
                        </a>
                    </div>
                @endforeach
            </div>

            <div class="mt-10">
                {{ $types->links() }}
            </div>
        @else
            <p class="text-zas-gray">Aún no hay tipos registrados.</p>
        @endif
    </div>
</x-app-layout>