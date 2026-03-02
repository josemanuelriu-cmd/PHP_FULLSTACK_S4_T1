@extends('layouts.app')

@section('content')


@if(isset($boardgames))            
    <h2>Listado juegos de mesa</h2>
    <a href="{{ route('boardgames.create') }}" method="get">Añadir nuevo juego de mesa</a>

    <ul>
        @foreach ($boardgames as $boardgame)
            <li>
                <a href="{{route('boardgames.show', $boardgame) }}">{{ $boardgame->name }}</a>
            </li>
                
        @endforeach
    </ul>
    {{ $boardgames->links() }}
@endif
@endsection