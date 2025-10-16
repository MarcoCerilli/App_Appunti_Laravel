@extends('index') {{-- Assumendo che 'index' sia il tuo layout principale --}}

@section('title', 'Dashboard Utente')

@section('content')
    <div class="space-y-6">

        {{-- PANNELLO DI BENVENUTO E STATISTICHE --}}
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl rounded-xl p-8 border-t-4 border-indigo-500">
            <h1 class="text-3xl font-extrabold text-gray-900 dark:text-gray-100 mb-2">
                Bentornato, {{ Auth::user()->name }}!
            </h1>
            <p class="text-lg text-gray-600 dark:text-gray-400">
                Questa è la tua area riservata per gestire le funzionalità dell'applicazione.
            </p>

            <hr class="my-4 border-gray-200 dark:border-gray-700">

            {{-- Statistiche (Esempio) --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">

                {{-- CARD 1: Appunti Totali (Placeholder) --}}
                <div class="p-4 bg-indigo-50 dark:bg-gray-700 rounded-lg shadow-sm flex items-center">
                    <svg class="w-8 h-8 text-indigo-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-300">I Tuoi Appunti</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">12</p> {{-- Valore dinamico da sostituire --}}
                    </div>
                </div>

                {{-- CARD 2: Ultimo Accesso --}}
                <div class="p-4 bg-indigo-50 dark:bg-gray-700 rounded-lg shadow-sm flex items-center">
                    <svg class="w-8 h-8 text-indigo-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-300">Ultimo Accesso</p>
                        {{-- Usiamo una data fittizia se non hai il campo last_login --}}
                        <p class="text-sm font-bold text-gray-900 dark:text-white">{{ date('d M Y, H:i') }}</p>
                    </div>
                </div>

                {{-- CARD 3: Link Veloce --}}
                <a href="{{ route('notes.index') }}" class="p-4 bg-indigo-500 hover:bg-indigo-600 text-white rounded-lg shadow-md transition duration-200 flex items-center">
                    <svg class="w-8 h-8 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    <div>
                        <p class="text-sm font-medium">Vai a Gestione Appunti</p>
                        <p class="text-xl font-bold">Inizia a Lavorare</p>
                    </div>
                </a>
            </div>
        </div>

        {{-- SEZIONE AZIONI RAPIDE --}}
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-4">Azioni Rapide</h3>
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('profile.edit') }}" class="bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 font-medium py-2 px-4 rounded-lg transition duration-150 shadow-sm">
                    Modifica Profilo
                </a>
                <a href="{{ route('notes.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-lg transition duration-150 shadow-md">
                    Visualizza Appunti
                </a>
            </div>
        </div>

    </div>
@endsection
