<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased relative min-h-screen bg-[#F3F4F6]">
        <div class="absolute inset-0 flex justify-center items-center pointer-events-none opacity-10">
            <img src="{{ asset('images/logo.png') }}" alt="ZAS Club Logo" class="w-1/2 h-auto object-contain">
        </div>
        <div class="relative z-10 min-h-screen">
            @include('layouts.navigation')

            @isset($header)
                <header class="bg-[#F3F4F6]  shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
