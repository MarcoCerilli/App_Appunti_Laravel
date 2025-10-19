@extends('layouts.guest') {{-- Estende il layout ospite che è ora neutro e scuro --}}

@section('title', 'Benvenuto')

<style>
    /* Stili per l'animazione di sfondo:
    Crea dei box che fluttuano in modo casuale per simulare particelle o "dati" in movimento.
    */
    .context {
        width: 100%;
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        overflow: hidden;
        /* Per assicurare che le particelle stiano dietro il contenuto */
        z-index: -1;
    }

    .boxes {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .boxes li {
        position: absolute;
        display: block;
        list-style: none;
        width: 20px;
        height: 20px;
        background: rgba(129, 140, 248, 0.2);
        /* Indaco semi-trasparente */
        animation: animate 25s linear infinite;
        bottom: -150px;
        border-radius: 50%;
    }

    /* Assegna diverse durate/dimensioni/posizioni iniziali */
    .boxes li:nth-child(1) {
        left: 25%;
        width: 80px;
        height: 80px;
        animation-delay: 0s;
        animation-duration: 10s;
    }

    .boxes li:nth-child(2) {
        left: 10%;
        width: 20px;
        height: 20px;
        animation-delay: 2s;
        animation-duration: 12s;
    }

    .boxes li:nth-child(3) {
        left: 70%;
        width: 20px;
        height: 20px;
        animation-delay: 4s;
        animation-duration: 9s;
    }

    .boxes li:nth-child(4) {
        left: 40%;
        width: 60px;
        height: 60px;
        animation-delay: 0s;
        animation-duration: 15s;
    }

    .boxes li:nth-child(5) {
        left: 65%;
        width: 20px;
        height: 20px;
        animation-delay: 0s;
        animation-duration: 7s;
    }

    .boxes li:nth-child(6) {
        left: 75%;
        width: 110px;
        height: 110px;
        animation-delay: 3s;
        animation-duration: 20s;
    }

    .boxes li:nth-child(7) {
        left: 35%;
        width: 150px;
        height: 150px;
        animation-delay: 7s;
        animation-duration: 18s;
    }

    .boxes li:nth-child(8) {
        left: 50%;
        width: 25px;
        height: 25px;
        animation-delay: 15s;
        animation-duration: 45s;
    }

    .boxes li:nth-child(9) {
        left: 20%;
        width: 15px;
        height: 15px;
        animation-delay: 2s;
        animation-duration: 35s;
    }

    .boxes li:nth-child(10) {
        left: 85%;
        width: 150px;
        height: 150px;
        animation-delay: 10s;
        animation-duration: 11s;
    }

    @keyframes animate {
        0% {
            transform: translateY(0) rotate(0deg);
            opacity: 1;
            border-radius: 0;
        }

        100% {
            transform: translateY(-1000px) rotate(720deg);
            opacity: 0;
            border-radius: 50%;
        }
    }
</style>

@section('content')
    {{-- Aggiungiamo un contenitore di contesto che avrà l'animazione di sfondo --}}
    <div class="context">
        <ul class="boxes">
            {{-- Inseriamo 20 elementi che verranno animati dal CSS --}}
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
    </div>

    {{-- Il contenuto della Home Page è centrato sopra lo sfondo animato --}}
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 text-center pt-8 pb-8 z-10 relative">

        <div
            class="p-8 bg-white/95 dark:bg-gray-800/95 backdrop-blur-sm shadow-2xl rounded-3xl lg:p-16 border-t-8 border-indigo-600 dark:border-indigo-400 transform transition duration-500 hover:shadow-indigo-500/50">

            {{-- NOTA: Ho aggiunto "bg-white/95 dark:bg-gray-800/95 backdrop-blur-sm" alla card per far intravedere l'animazione, migliorando l'effetto "fluttuante". --}}

            {{-- Logo o Icona --}}
            <div class="flex justify-center mb-8">
                <svg class="w-20 h-20 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z">
                    </path>
                </svg>
            </div>

            <h1 class="text-5xl font-extrabold mb-4 text-gray-900 dark:text-white tracking-tight sm:text-6xl lg:text-7xl">
                Dai forma alle tue idee con {{ config('app.name', 'La Tua App') }}
            </h1>

            <p class="mt-4 text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto">
                La piattaforma per gestire appunti, progetti e flussi di lavoro in modo semplice e intuitivo. Inizia
                ora!
            </p>

            <div class="mt-12 flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0 sm:space-x-4">
                @if (Route::has('login'))
                    @auth
                        {{-- Se loggato --}}
                        <a href="{{ url('/dashboard') }}"
                            class="inline-flex items-center justify-center px-10 py-4 border border-transparent text-lg font-bold rounded-xl text-white bg-green-500 hover:bg-green-600 shadow-xl transition duration-300 transform hover:scale-[1.05]">
                            Vai alla Dashboard
                        </a>
                    @else
                        {{-- Pulsanti per Ospiti --}}
                        <a href="{{ route('login') }}"
                            class="inline-flex items-center justify-center px-10 py-4 border border-transparent text-lg font-bold rounded-xl text-white bg-indigo-600 hover:bg-indigo-700 shadow-xl transition duration-300 transform hover:scale-[1.05]">
                            Accedi Subito
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="inline-flex items-center justify-center px-10 py-4 border border-transparent text-lg font-bold rounded-xl text-indigo-700 bg-indigo-100 hover:bg-indigo-200 dark:bg-indigo-700 dark:text-white dark:hover:bg-indigo-600 shadow-md transition duration-300 transform hover:scale-[1.05]">
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
@endsection
