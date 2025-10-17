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

    <!-- Styling per un look più moderno e coerente con lo sfondo scuro della Home -->
    <style>
        /* Imposta il corpo della pagina, ma la classe bg-gray-900 (dark) è già nel <body> */
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        main {
            flex-grow: 1; /* Assicura che il contenuto riempia lo spazio rimanente */
        }
    </style>
</head>
<body class="font-sans text-gray-900 antialiased bg-gray-900 dark">
    {{-- La classe dark nel body attiva la modalità scura per tutti i componenti Tailwind --}}

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
                    <a href="{{ url('/dashboard') }}" class="text-sm text-gray-300 hover:text-indigo-400 font-semibold transition duration-150">Dashboard</a>
                @else
                    {{-- Ospite --}}
                    <a href="{{ route('login') }}" class="text-sm text-gray-300 hover:text-indigo-400 font-semibold transition duration-150 px-3 py-1.5 rounded-lg border border-transparent hover:border-indigo-400">Log In</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="text-sm text-white bg-indigo-600 hover:bg-indigo-700 py-1.5 px-3 rounded-lg font-semibold transition duration-150 shadow-lg">Registrati</a>
                    @endif
                @endauth
            </nav>
        </div>
    </header>

    {{-- CONTENUTO PRINCIPALE --}}
    <main class="flex flex-col flex-grow">
        {{-- Questo è lo slot di contenuto che welcome.blade.php riempirà con @section('content') --}}
        @yield('content')
    </main>

    {{-- FOOTER MINIMALE e TRASPARENTE --}}
    <footer class="py-4 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-sm text-gray-400">
            &copy; {{ date('Y') }} {{ config('app.name', 'Laravel App') }}.
        </div>
    </footer>

</body>
</html>
