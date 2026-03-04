<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-zas-primary leading-tight">
                🎲 ZAS
            </h2>
        </div>
    </x-slot>

    <div class="max-w-3xl mx-auto px-4 py-8">

        <h2 class="text-3xl font-bold text-gray-800 mb-6">➕ Añadir nueva sesión</h2>

            <a href="{{ route('sessions_zas.index') }}"
            class="text-zas-primary hover:underline mb-6 inline-block">
                ← Volver al listado
            </a>

        <form action="{{ route('sessions_zas.store') }}" method="post"
            class="bg-white shadow-lg rounded-xl p-6 space-y-4 border border-zas-primary/30">
            @csrf

            @include('sessions_zas.Form')

            
            <div  class="grid md:grid-cols-3 gap-4">
                <button type="submit"
                    class="bg-zas-primary text-white px-6 py-2 rounded-lg hover:bg-zas-primaryHover transition">
                    Guardar sesión
                </button>
                <button type="reset"
                    class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-400 transition">
                    Limpiar formulario
                </button>
                <a href="{{ route('sessions_zas.index') }}"
                class="bg-zas-dark text-white px-6 py-2 rounded-lg hover:bg-zas-darkSoft transition text-center">Cancelar</a>
            </div>
        </form>

    </div>
</x-app-layout>
