@extends('layouts.app')

@section('content')

    <h2>Añadir nuevo juego de mesa</h2>
    <a href="{{ route('boardgames.index') }}">Volver al listado de juegos con nombre de ruta</a>
    <br>
    {{--@if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif--}}
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

@endsection
