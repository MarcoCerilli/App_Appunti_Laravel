@extends('layouts.guest') {{-- Estende il layout ospite che è ora neutro e scuro --}}

@section('title', 'Benvenuto')

@section('content')
    {{--
        Contenitore esterno per centrare la card sia orizzontalmente che verticalmente.
        - flex-grow: Assicura che questo div prenda tutto lo spazio verticale disponibile nella <main> del layout.
        - bg-gray-900: Rimuovi se lo sfondo è gestito dal body nel layout, ma lo tengo qui come fallback.
        - items-center & justify-center: Centra il contenuto.
    --}}
    <div class="flex flex-col flex-grow items-center justify-center bg-gray-900 min-h-screen -mt-[64px] pb-16">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 text-center pt-16">

            <div class="p-8 bg-white dark:bg-gray-800 shadow-2xl rounded-3xl lg:p-16 border-t-8 border-indigo-600 dark:border-indigo-400 transform transition duration-500 hover:shadow-indigo-500/50">

                {{-- Logo o Icona --}}
                <div class="flex justify-center mb-8">
                    {{-- Ho cambiato il colore dell'SVG per adattarsi alla modalità scura --}}
                    <svg class="w-20 h-20 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>

                <h1 class="text-5xl font-extrabold mb-4 text-gray-900 dark:text-white tracking-tight sm:text-6xl lg:text-7xl">
                    Dai forma alle tue idee con {{ config('app.name', 'La Tua App') }}
                </h1>

                <p class="mt-4 text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto">
                    La piattaforma definitiva per gestire appunti, progetti e flussi di lavoro in modo semplice e intuitivo. Inizia ora!
                </p>

                <div class="mt-12 flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0 sm:space-x-4">
                    @if (Route::has('login'))
                        @auth
                            {{-- Se loggato --}}
                            <a href="{{ url('/dashboard') }}" class="inline-flex items-center justify-center px-10 py-4 border border-transparent text-lg font-bold rounded-xl text-white bg-green-500 hover:bg-green-600 shadow-xl transition duration-300 transform hover:scale-[1.05]">
                                Vai alla Dashboard
                            </a>
                        @else
                            {{-- Pulsanti per Ospiti --}}
                            <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-10 py-4 border border-transparent text-lg font-bold rounded-xl text-white bg-indigo-600 hover:bg-indigo-700 shadow-xl transition duration-300 transform hover:scale-[1.05]">
                                Accedi Subito
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-10 py-4 border border-transparent text-lg font-bold rounded-xl text-indigo-700 bg-indigo-100 hover:bg-indigo-200 dark:bg-indigo-700 dark:text-white dark:hover:bg-indigo-600 shadow-md transition duration-300 transform hover:scale-[1.05]">
                                    Crea un Account
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>

            {{-- Optional: Informazione sulla tecnologia --}}
            <div class="mt-12 text-sm text-gray-400 dark:text-gray-500">
                Costruito con Laravel e Tailwind CSS.
            </div>

        </div>
    </div>
@endsection
