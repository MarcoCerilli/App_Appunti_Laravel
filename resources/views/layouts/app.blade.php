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

<body class="font-sans antialiased bg-gray-100 dark:bg-gray-900">
    {{-- Contenitore Flex principale per gestire la sidebar e il contenuto --}}
    {{-- CORREZIONE: In modalità ospite, usiamo un layout semplice centrato, altrimenti usiamo Flex per la sidebar --}}
    <div class="min-h-screen w-full @auth flex @endauth">

        {{-- Sidebar (Solo per utenti autenticati) --}}
        @auth
            <div class="sidebar">
                @include('partials.sidebar')
            </div>
        @endauth

        {{-- CONTENUTO PRINCIPALE --}}
        {{-- In modalità ospite, usiamo le classi di centratura Flexbox che ora agiscono sull'intera pagina --}}
        <div class="main-content @auth flex-grow @endauth @guest flex flex-col items-center w-full !ml-0 !w-full @endguest">

            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow w-full">
                    <div class="max-w-full mx-auto py-6 px-4">
                        {{ $header }}
                    </div>
                </header>
            @endisset


            {{-- MAIN CONTENT AREA --}}
            {{-- RIMOSSA w-full e mx-auto, la centratura è gestita dal genitore. --}}
            
            <main class="@guest pt-10 @endguest">
                @hasSection('content')
                    @yield('content')
                @else
                    {{ $slot }}
                @endif
            </main>

            @include('partials.footer')
        </div>
    </div>
</body>
</html>
