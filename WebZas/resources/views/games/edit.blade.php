<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-zas-primary leading-tight">
                📅 {{ __('Sesiones') }}
            </h2>
        </div>
    </x-slot>

    <div class="max-w-3xl mx-auto px-4 py-8">
        <div class="bg-zas-light border border-zas-primary/20 rounded-xl p-6 shadow-md hover:shadow-xl hover:border-zas-primary transition">
            <h2 class="text-2xl font-bold mb-6">
            Editando la partida en {{ $zassession->name }} el dia {{ ucfirst(\Carbon\Carbon::parse($zassession->date)->isoFormat('DD-MM-YYYY')) }}
            </h2>

            @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <form method="POST" action="{{ route('games.update', [$zassession, $game]) }}">
                @csrf
                @method('PUT')

                @include('games.Form')
 
                <button type="submit" class="bg-zas-primary text-white px-6 py-2 rounded-lg hover:bg-zas-primaryHover transition">
                    Guardar cambios
                </button>
                
                <a href="{{ route('games.show', [$zassession, $game]) }}" class="bg-zas-dark px-4 py-2 rounded-lg text-white hover:bg-zas-darkSoft transition">
                    Cancelar
                </a>

            </form>
        </div>
    </div>

</x-app-layout>