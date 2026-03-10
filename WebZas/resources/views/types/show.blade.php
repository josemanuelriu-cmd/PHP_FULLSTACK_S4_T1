<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-zas-primary leading-tight">
                🧮 {{ __('Tipos de juego') }}
            </h2>

        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto px-4 py-10">

        <a href="{{ route('types.index') }}"
        class="text-zas-primary hover:underline">
            ← Volver al listado
        </a>

        <div class="bg-white border border-zas-primary
                    rounded-2xl p-10 mt-6 shadow-2xl">

            <h2 class="text-4xl font-bold text-zas-primary mb-8">
                {{ $type->type }}
            </h2>
            <p>
                {{ $type->description }}
            </p>

            <div class="flex gap-4 mt-10">
                <a href="{{ route('types.edit', $type) }}"
                class="bg-zas-primary px-4 py-2 rounded-lg text-white hover:bg-zas-primaryHover transition">
                    Editar
                </a>

                <form action="{{ route('types.destroy', $type) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            onclick="return confirm('¿Seguro que quieres eliminar este tipo?')"
                            class="bg-zas-dark px-4 py-2 rounded-lg text-white hover:bg-zas-darkSoft transition">
                        Borrar
                    </button>
                </form>
            </div>

        </div>

    </div>
</x-app-layout>