@extends('index')

@section('title', 'Service Providers')

@section('content')
    <div class="p-6 lg:p-8 bg-white shadow-xl rounded-lg border border-gray-100">
        {{-- HEADLINE per la lezione --}}
        <h1 class="text-3xl font-bold mb-8 text-gray-800 border-b pb-4">
            🎓 Lezione 120: Service Providers e Architettura
        </h1>

        @include('partials.service_providers_content')

    </div>
@endsection
