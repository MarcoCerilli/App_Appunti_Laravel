@extends('layouts.app')

{{-- IMPOSTAZIONI LAYOUT PER NASCONDERE LA SIDEBAR --}}
{{-- 1. Forza la logica "Auth/No Layout" nel layout app.blade.php --}}
<?php $hideLayout = true; ?>
{{-- 2. Forza la centratura verticale per la card (opzionale, ma consigliata per consistenza) --}}
<?php $centerVertically = true; ?>

@section('title', 'Verifica Email')

@section('content')
    {{-- Contenitore principale centrato, come in register.blade.php --}}
    {{-- NOTE: L'uso di flex-col items-center pt-6 ecc. è ridondante qui se $centerVertically è true nel layout app.blade.php, --}}
    {{-- ma lo lasciamo per sicurezza se il tuo contenuto in @section('content') è richiesto. --}}
    <div class="flex flex-col items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900 min-h-screen">
        {{-- Card del Messaggio - Stessa struttura usata in manual-login/register --}}
        <div
            class="max-w-5xl w-full lg:min-w-[450px] px-6 py-8 mt-6 bg-white dark:bg-gray-800 shadow-2xl overflow-hidden sm:rounded-xl">
            <h2 class="text-3xl font-extrabold text-gray-900 dark:text-gray-100 text-center mb-8 border-b pb-4">
                Verifica il tuo Indirizzo Email
            </h2>

            {{-- 1. Messaggio di Richiesta Principale --}}
            <div class="mb-4 text-base text-gray-600 dark:text-gray-400">
                {{ __('Grazie per esserti registrato! Prima di iniziare, potresti verificare il tuo indirizzo email cliccando sul link che ti abbiamo appena inviato? Se non hai ricevuto l\'email, saremo lieti di inviartene un\'altra.') }}
            </div>

            {{-- 2. Messaggio di Stato: Link Reinviato --}}
            @if (session('status') == 'verification-link-sent')
                <div class="mb-4 p-3 bg-green-100 border border-green-400 text-green-700 rounded-lg font-medium text-sm">
                    {{ __('Un nuovo link di verifica è stato inviato all\'indirizzo email fornito durante la registrazione.') }}
                </div>
            @endif

            {{-- 3. Form per Reinviare l'Email di Verifica e Logout --}}
            <div class="mt-8 flex items-center justify-between">

                {{-- Form Reinvia Email --}}
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf

                    <button type="submit"
                        class="inline-flex justify-center items-center px-4 py-2 bg-indigo-600 border border-transparent
                            rounded-lg font-semibold text-xs text-white uppercase tracking-widest
                            hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2
                            focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-lg">
                        {{ __('Reinvia Email di Verifica') }}
                    </button>
                </form>

                {{-- Form Logout --}}
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit"
                        class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                        {{ __('Esci') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
