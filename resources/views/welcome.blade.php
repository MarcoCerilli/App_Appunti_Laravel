@extends('index') {{-- Estendi il layout principale con la Sidebar --}}

@section('title', 'Welcome')

@section('content')
    {{-- Aggiungi un wrapper Tailwind per lo stile e la spaziatura --}}
    <div class="p-6 lg:p-8 bg-white shadow-md rounded-lg">

        <h1 class="text-3xl font-bold mb-6 text-gray-800">Benvenuto in Laravel!</h1>

        <div id="app" class="text-xl text-gray-700">
            Welcome to Laravel!
        </div>

        <p class="mt-4 text-gray-500">
            Questa pagina è stata adattata per usare il tuo layout Sidebar personalizzato.
        </p>

    </div>
@endsection
