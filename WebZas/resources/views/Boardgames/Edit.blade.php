@extends('layouts.app')

@section('content')

<h2>Editar juego de mesa</h2>
<a href="{{ route('boardgames.index') }}">Volver al listado de juegos con nombre de ruta</a>
<br>
    <form action="{{ route('boardgames.update', $boardgame) }}" method="post">
        @csrf
        @method('PUT')
        <label for="name">Nombre del juego:</label>
        <input type="text" name="name" value="{{ old('name', $boardgame->name) }}" placeholder="Nombre del juego">
        @error('name')<div class="alert alert-danger">{{ $message }}</div>@enderror
        <BR>
        <label for="slug">Slug del juego:</label>
        <input type="text" name="slug" value="{{ old('slug', $boardgame->slug) }}" placeholder="Slug del juego">
        @error('slug')<div class="alert alert-danger">{{ $message }}</div>@enderror
        <BR>
        <label for="min_players">Número de jugadores:</label>
        <input type="number" name="min_players" value="{{ old('min_players', $boardgame->min_players) }}" placeholder="Minimo de jugadores">
        @error('min_players')<div class="alert alert-danger">{{ $message }}</div>@enderror
        <BR>
        <label for="max_players">Número de jugadores:</label>
        <input type="number" name="max_players" value="{{ old('max_players', $boardgame->max_players) }}" placeholder="Maximo de jugadores">
        @error('max_players')<div class="alert alert-danger">{{ $message }}</div>@enderror
        <BR>
        <label for="min_age">Edad minima:</label>
        <input type="number" name="min_age" value="{{ old('min_age', $boardgame->min_age) }}" placeholder="Edad minima">
        @error('min_age')<div class="alert alert-danger">{{ $message }}</div>@enderror
        <BR>
        <label for="duration">Duración del juego:</label>
        <input type="number" name="duration" value="{{ old('duration', $boardgame->duration) }}" placeholder="Tiempo de juego (minutos)">
        @error('duration')<div class="alert alert-danger">{{ $message }}</div>@enderror
        <BR>
        <label for="description">Descripción del juego:</label>
        <input type="text" name="description" value="{{ old('description', $boardgame->description) }}" placeholder="Descripcion del juego">
        @error('description')<div class="alert alert-danger">{{ $message }}</div>@enderror
        <BR>
        <button type="submit">Actualizar juego</button>
    </form>

@endsection