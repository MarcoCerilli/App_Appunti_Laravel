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

{{--
    LOGICA DI CONTROLLO DEL LAYOUT UNIFICATA
    ---------------------------------------
    1. $hideLayout: Nasconde Sidebar, Header e Footer. Si applica a tutte le pagine Auth (Login, Register, ecc.)
    2. $centerVertically: Centra verticalmente il contenuto del main. Si applica solo a specifiche pagine (es. Login Manuale).
--}}
@php
    // 1. Dichiara $hideLayout. È TRUE se non sei loggato O se la vista lo imposta.
    $hideLayout = !Auth::check() || (isset($hideLayout) && $hideLayout === true);

    // 2. Dichiara $centerVertically. È TRUE solo se la vista lo imposta.
    $centerVertically = (isset($centerVertically) && $centerVertically === true);
@endphp

{{--
    CONTENITORE RADICE:
    - min-h-screen per coprire tutta l'altezza.
    - flex-col se Auth (per impilare) o flex se Dashboard (per affiancare sidebar).
--}}
<div class="min-h-screen w-full @if(!$hideLayout) flex @else flex flex-col @endif">

    {{-- ========================================================= --}}
    {{-- BLOCCO SIDEBAR e HEADER (Visibili solo se $hideLayout è FALSE) --}}
    {{-- ========================================================= --}}
    @if (!$hideLayout)
        {{-- La tua Sidebar qui (presumo sia un flex item fisso) --}}
        <div class="sidebar">
            @include('partials.sidebar')
        </div>

        {{-- Contenitore principale (Header + Main) affiancato alla Sidebar --}}
        <div class="main-content flex-grow flex flex-col">
            {{-- HEADER --}}
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow w-full">
                    <div class="max-w-full mx-auto py-6 px-4">
                        {{ $header }}
                    </div>
                </header>
            @endisset
    @endif

    {{-- ========================================================= --}}
    {{-- MAIN CONTENT AREA (CONTENUTO EFFETTIVO DELLA VISTA) --}}
    {{-- ========================================================= --}}
    <main class="@if(!$hideLayout) flex-grow @else w-full @endif
        {{-- Centratura solo se richiesta esplicitamente dalla vista --}}
        @if($centerVertically)
            {{-- Per centrare perfettamente, il main deve occupare tutto lo spazio disponibile --}}
            flex-grow flex justify-center items-center
        @else
            {{-- Altrimenti, usa padding standard --}}
            pt-6 pb-6
        @endif
        {{-- Aggiungo qui anche la centratura orizzontale se siamo in modalità Auth non centrata verticalmente (caso Login standard) --}}
        @if($hideLayout && !$centerVertically)
            flex justify-center
        @endif
    ">
        @hasSection('content')
            @yield('content')
        @else
            {{ $slot }}
        @endif
    </main>

    {{-- Chiude il main-content div e include il footer se non è in modalità Auth --}}
    @if (!$hideLayout)
        {{-- FOOTER (opzionale) --}}
        @include('partials.footer')
        </div>
    @endif

</div>


</body>
</html>
