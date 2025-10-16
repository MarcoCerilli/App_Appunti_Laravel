@extends('index')

@section('title', 'Guards & Providers')

@section('content')
    <div class="p-6 lg:p-8 bg-white shadow-xl rounded-lg border border-gray-100">
        {{-- HEADLINE per la lezione --}}
        <h1 class="text-3xl font-bold mb-8 text-gray-800 border-b pb-4">
            🔒 Lezione 96-100: Guards, Providers e Custom Guards
        </h1>

        @include('partials.guards_content')

    </div>
@endsection
