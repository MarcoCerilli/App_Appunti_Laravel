@extends('index')

@section('title', 'Condizionali Blade')
@section('active-condizionali', 'active')

@section('content')
    {{--
        Sostituisce la classe Bootstrap .jumbotron
        con classi di spaziatura Tailwind (p-6/p-8) per l'effetto di "area ampia"
    --}}
    <div class="p-6 lg:p-8 bg-white shadow-md rounded-lg">

        {{-- HEADLINE: H1 di grandi dimensioni con margine inferiore --}}
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Condizionali Blade</h1>

        {{-- INCLUDE DEL CONTENUTO: Il contenuto parziale convertito in Tailwind --}}
        @include('partials.condizionali_content', [
            'logged_in' => $logged_in ?? false,
            'username' => $username ?? 'Utente',
            'user_role' => $user_role ?? 'guest',
            'empty_list' => $empty_list ?? []
        ])
    </div>
@endsection
