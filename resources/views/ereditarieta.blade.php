@extends('index')

@section('title', 'Ereditarietà Blade')
@section('active-ereditarieta', 'active')

@section('content')
    {{--
        Sostituisce la classe Bootstrap .jumbotron.
        Utilizza un wrapper con padding, sfondo bianco e ombra per l'area di lezione.
    --}}
    <div class="p-6 lg:p-8 bg-white shadow-md rounded-lg">

        {{-- HEADLINE: Titolo principale con spaziatura --}}
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Ereditarietà delle Viste</h1>

        {{-- INCLUDE DEL CONTENUTO: Il contenuto della lezione (assumendo sia già stato convertito a Tailwind) --}}
        @include('partials.ereditarieta_content')
    </div>
@endsection
