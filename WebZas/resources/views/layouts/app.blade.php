<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    
        //usamos tailwind recompilado localmente para evitar problemas de conexión con el CDN
        <script src="https://cdn.tailwindcss.com"></script> 
    -->   
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Web Zas</title>
</head>
<body class="relative bg-gray-100 text-gray-800 min-h-screen overflow-x-hidden">

    <!-- Marca de agua -->
    <div class="fixed inset-0 flex items-center justify-center pointer-events-none z-0 opacity-10 grayscale">
        <img src="{{ asset('images/escudo-zas.png') }}"
             class="w-[600px] md:w-[900px]">
    </div>

    <!-- Contenido real -->
    <div class="relative z-10">

        <nav class="bg-zas-primary shadow-lg">
            <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
                <div class="flex items-center gap-4">
                    <img src="{{ asset('images/escudo-zas.png') }}" class="h-12">
                    <span class="text-2xl font-bold text-white tracking-wide">
                        ZAS! Juegos de mesa y rol
                    </span>
                </div>
            </div>
        </nav>

        <main>
            @yield('content')
        </main>

    </div>

</body>
</html>