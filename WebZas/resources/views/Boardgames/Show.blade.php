@extends('layouts.app')

@section('content')

<a href="{{ route('boardgames.index') }}">Volver al listado de juegos con nombre de ruta</a>
<br>

<h2>juego de mesa concreto: {{ $boardgame->name }}</h2>
<p>Numero de jugadores: {{ $boardgame->min_players }} - {{ $boardgame->max_players }}</p>
<p>Edad minima: {{ $boardgame->min_age }}</p>
<p>Duración del juego: {{ $boardgame->duration }} minutos</p>
<p>Descripción del juego: {{ $boardgame->description }}</p>
<a href="{{ route('boardgames.edit', $boardgame) }}">Editar juego</a>
<form action="{{ route('boardgames.destroy', $boardgame) }}" method="post">
    @csrf
    @method('DELETE')
    <button type="submit">Borrar juego</button>
</form>

@endsection