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
            Crear partida en {{ $zassession->name }} el dia {{ ucfirst(\Carbon\Carbon::parse($zassession->date)->isoFormat('DD-MM-YYYY')) }}
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
            
            <form method="POST" action="{{ route('games.store', $zassession) }}">
                @csrf
                <!--
                <input type="text"  name="zassession_id" value="{{ $zassession->id }}">
                <input type="text"  name="host_user_id" value="{{ Auth::user()->id }}">
                -->
                <div class="grid md:grid-cols-2 gap-4 my-4">
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Juego - jugadores máximos</label>
                        <select name="boardgame_id" class="border-zas-primary border rounded-lg shadow-sm focus:ring-zas-primary focus:border-zas-primary pl-2 text-zas-primary">
                            @foreach($boardgames as $game)
                                <option value="{{ $game->id }}" class="text-zas-primary">
                                    {{ $game->name }} - {{ $game->max_players}}
                                </option>

                            @endforeach
                        </select>
                        <div class="my-4">
                            <label class="block text-gray-700 font-semibold mb-2">Tipo partida</label>
                            <select name="status" class="border-zas-primary border rounded-lg shadow-sm focus:ring-zas-primary focus:border-zas-primary pl-2 text-zas-primary">
                                <option value="open" class="text-zas-primary">Abierta a todo el mundo</option>
                                <option value="limited" class="text-zas-primary">Solo para soci@s</option>
                            </select>
                        </div>
                        <div class="my-4">
                            <label class="block text-gray-700 font-semibold mb-2">Hora de inicio</label>
                            <input type="time" name="start_time" class="rounded border-zas-primary text-zas-primary shadow-sm focus:ring-zas-primary">
                        </div>
                        <div class="my-4">                            
                            <input type="checkbox" name="necesary_know_how" class="rounded border-zas-primary text-zas-primary shadow-sm focus:ring-zas-primary" value="1">
                            <span>Obligatorio saber jugar</span>
                        </div>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Apuntar jugadores</label>
                        <lu class="text-zas-primary list-inside">
                            @foreach($users as $user)
                                <li class="list-none">
                                    <input type="checkbox" name="players[]" class="rounded border-zas-primary text-zas-primary shadow-sm focus:ring-zas-primary" value="{{ $user->id }}">
                                    {{ $user->nickname }}
                                </li>
                            @endforeach
                        </lu>

                    </div>
                </div>
                
                
                
 
                <button type="submit" class="bg-zas-primary text-white px-6 py-2 rounded-lg hover:bg-zas-primaryHover transition">
                    Crear partida
                </button>
                <a href="{{ route('zassessions.show', $zassession) }}"
                           class="bg-zas-dark px-4 py-2 rounded-lg text-white hover:bg-zas-darkSoft transition">
                    Cancelar
                </a>

            </form>
        </div>
    </div>

</x-app-layout>