@extends('index')

@section('title', 'Include Blade')
@section('active-include', 'active')

@section('content')
    {{--
        Sostituisce la classe Bootstrap .jumbotron
        con classi di spaziatura Tailwind per l'effetto di "area ampia" e sfondo bianco.
    --}}
    <div class="p-6 lg:p-8 bg-white shadow-md rounded-lg">

        {{-- HEADLINE: H1 di grandi dimensioni con margine inferiore --}}
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Include di Partials</h1>

        {{-- INCLUDE DEL CONTENUTO: Il contenuto parziale convertito in Tailwind --}}
        @include('partials.include_content')
    </div>
@endsection
