@extends('index')

@section('title', 'Seeders')

@section('content')
    {{-- Sostituisce la classe Bootstrap .jumbotron con classi di spaziatura Tailwind --}}
    <div class="p-6 lg:p-8 bg-white shadow-md rounded-lg">
        {{-- HEADLINE per la lezione, se non è inclusa nel partial --}}
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Seeders e Data Fabbricazione</h1>

        @include('partials.seeders_content')

    </div>
    {{-- NOTA: Ho aggiunto il tag di chiusura </div> mancante. --}}
@endsection
