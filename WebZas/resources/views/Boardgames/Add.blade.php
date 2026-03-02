@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-8">

    <h2 class="text-3xl font-bold text-gray-800 mb-6">➕ Añadir nuevo juego</h2>

    <a href="{{ route('boardgames.index') }}"
       class="text-zas-primary hover:underline mb-6 inline-block">
        ← Volver al listado
    </a>

    <form action="{{ route('boardgames.store') }}" method="post"
          class="bg-white shadow-lg rounded-xl p-6 space-y-4 border border-zas-primary/30">
        @csrf

        @include('boardgames.Form')

        <!--
    <form action="{{ route('boardgames.store') }}" method="post">
        @csrf
        <label for="name">Nombre del juego:</label>
        <input type="text" name="name" placeholder="Nombre del juego" value="{{ old('name') }}">
        @error('name')<div class="alert alert-danger">{{ $message }}</div>@enderror
        <BR>
        <label for="slug">Slug del juego:</label>
        <input type="text" name="slug" placeholder="Slug del juego" value="{{ old('slug') }}">
        @error('slug')<div class="alert alert-danger">{{ $message }}</div>@enderror
        <BR>
        <label for="min_players">Número de jugadores:</label>
        <input type="number" name="min_players" placeholder="Minimo de jugadores" value="{{ old('min_players') }}">
        @error('min_players')<div class="alert alert-danger">{{ $message }}</div>@enderror
        <BR>
        <label for="max_players">Número de jugadores:</label>
        <input type="number" name="max_players" placeholder="Maximo de jugadores" value="{{ old('max_players') }}">
        @error('max_players')<div class="alert alert-danger">{{ $message }}</div>@enderror
        <BR>
        <label for="min_age">Edad minima:</label>
        <input type="number" name="min_age" placeholder="Edad minima" value="{{ old('min_age') }}">
        @error('min_age')<div class="alert alert-danger">{{ $message }}</div>@enderror
        <BR>
        <label for="duration">Duración del juego:</label>
        <input type="number" name="duration" placeholder="Tiempo de juego (minutos)" value="{{ old('duration') }}">
        @error('duration')<div class="alert alert-danger">{{ $message }}</div>@enderror
        <BR>
        <label for="description">Descripción del juego:</label>
        <textarea name="description" placeholder="Descripcion del juego">{{ old('description') }}</textarea>
        @error('description')<div class="alert alert-danger">{{ $message }}</div>@enderror
        <BR>
        <button type="submit">Añadir juego</button>
    </form>
-->
        <div  class="grid md:grid-cols-3 gap-4">
            <button type="submit"
                class="bg-zas-primary text-white px-6 py-2 rounded-lg hover:bg-zas-primaryHover transition">
                Guardar juego
            </button>
            <button type="reset"
                class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-400 transition">
                Limpiar formulario
            </button>
            <a href="{{ route('boardgames.index') }}"
            class="bg-zas-dark text-white px-6 py-2 rounded-lg hover:bg-zas-darkSoft transition text-center">Cancelar</a>
        </div>
    </form>

</div>
@endsection
