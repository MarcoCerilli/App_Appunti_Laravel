@extends('index')

@section('title', 'Autorizzazione Flessibile (Middleware vs Controller)')

@section('content')
    <div class="p-6 lg:p-8 bg-white shadow-xl rounded-lg border border-gray-100">
        {{-- HEADLINE per la lezione --}}
        <h1 class="text-3xl font-bold mb-8 text-gray-800 border-b pb-4">
            🎓 Lezione 121: Autorizzazione Flessibile
        </h1>

        @include('partials.lesson_121_content')

    </div>
@endsection
