<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Zas!') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-[#F3F4F6]" relative min-h-screen">

        @include('layouts.guestNavigation')
        <!-- Marca de agua -->
        <div class="absolute inset-0 flex justify-center items-center pointer-events-none opacity-10">
            <img src="{{ asset('images/logo.png') }}" alt="ZAS Club Logo" class="w-1/2 h-auto object-contain">
        </div>

        <!-- Contenido de la página -->
        <div class="relative z-10 flex flex-col justify-center min-h-screen">
            {{ $slot ?? $content }}
        </div>
    </body>
</html>
