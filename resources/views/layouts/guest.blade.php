<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Laravel'))</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Styling per assicurare che body e main gestiscano bene lo spazio */
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Rimuoviamo il flex-grow da main qui, lo useremo nel div interno */
        .page-content-wrapper {
            flex-grow: 1; /* NECESSARIO per spingere il footer in fondo */
        }
    </style>
</head>

{{-- Abbiamo la classe dark nel body e bg-gray-900 per lo sfondo --}}

<body class="font-sans text-gray-900 antialiased bg-gray-900 dark">

    {{-- HEADER MINIMALE e TRASPARENTE --}}
    <header class="py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">

            {{-- Logo --}}
            <a href="{{ url('/') }}" class="text-white text-lg font-bold">
                {{-- Usa qui il tuo componente x-application-logo se lo hai --}}
                <x-application-logo class="w-10 h-10 fill-current text-white" />
            </a>

            {{-- Navigazione per Ospiti --}}
            <nav class="flex items-center space-x-4">
                @auth
                    {{-- Utente loggato --}}
                    <a href="{{ url('/dashboard') }}"
                        class="text-sm text-gray-300 hover:text-indigo-400 font-semibold transition duration-150">Dashboard</a>
                @else
                    {{-- Ospite --}}
                    <a href="{{ route('login') }}"
                        class="text-sm text-gray-300 hover:text-indigo-400 font-semibold transition duration-150 px-3 py-1.5 rounded-lg border border-transparent hover:border-indigo-400">Log
                        In</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="text-sm text-white bg-indigo-600 hover:bg-indigo-700 py-1.5 px-3 rounded-lg font-semibold transition duration-150 shadow-lg">Registrati</a>
                    @endif
                @endauth
            </nav>
        </div>
    </header>

    {{-- CONTENUTO PRINCIPALE (con centratura del form) --}}
    <div class="page-content-wrapper flex flex-col items-center justify-center">
        {{-- Ho cambiato justify-start in justify-center per la home page --}}
        {{-- Inoltre ho rimosso py-10, lo gestiamo nel contenuto specifico se necessario --}}

        {{-- Caso 1: È un Componente Blade (<x-guest-layout>), come le form di autenticazione --}}
        @if (isset($slot))
            <main class="w-full sm:max-w-md px-6 py-4 bg-white dark:bg-gray-800 shadow-xl rounded-xl">
                {{ $slot }}
            </main>
        @else
            {{-- Caso 2: È un Layout Esteso (@extends), come la Home Page --}}
            {{-- Avvolgiamo il contenuto in un div a tutta larghezza e altezza per farlo estendere --}}
            <div class="w-full h-full flex items-center justify-center">
                @yield('content')
            </div>
        @endif
    </div>

    {{-- FOOTER MINIMALE --}}
    <footer class="pt-4 pb-4 border-t border-gray-700 text-center text-gray-400 text-lg w-full">
        <div class="max-w-md mx-auto">
            <small>© 2025 Marco Cerilli — PHP, Symfony & Laravel Specialist</small>
        </div>
    </footer>

</body>

</html>
