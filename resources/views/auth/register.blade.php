@extends('layouts.app')

@section('title', 'Registrazione Utente')

@section('content')
    {{-- Inseriamo il contenuto del form all'interno di un div centrato --}}
    <div class="flex flex-col items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900 min-h-screen">
        {{-- Card del Form - Stessa struttura usata in manual-login.blade.php --}}
        <div
            class="max-w-5xl w-full lg:min-w-[450px] px-6 py-8 mt-6 bg-white dark:bg-gray-800 shadow-2xl overflow-hidden sm:rounded-xl">
            <h2 class="text-3xl font-extrabold text-gray-900 dark:text-gray-100 text-center mb-8 border-b pb-4">
                Registrati
            </h2>

            {{-- Messaggi di Errore - Stessa visualizzazione usata in manual-login --}}
            @if ($errors->any())
                <div class="mb-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                    @foreach ($errors->all() as $error)
                        <p class="text-sm">{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="mt-4">
                    <label for="name" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Nome</label>
                    <input id="name"
                        class="block mt-1 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200
                            focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm"
                        type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" />
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <label for="email" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Email</label>
                    <input id="email"
                        class="block mt-1 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200
                            focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm"
                        type="email" name="email" value="{{ old('email') }}" required autocomplete="username" />
                </div>

                <!-- Password -->
                <div class="mt-6">
                    <label for="password"
                        class="block font-medium text-sm text-gray-700 dark:text-gray-300">Password</label>
                    <input id="password"
                        class="block mt-1 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200
                            focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm"
                        type="password" name="password" required autocomplete="new-password" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <label for="password_confirmation"
                        class="block font-medium text-sm text-gray-700 dark:text-gray-300">Conferma Password</label>
                    <input id="password_confirmation"
                        class="block mt-1 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200
                            focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm"
                        type="password" name="password_confirmation" required autocomplete="new-password" />
                </div>

                <div class="flex items-center justify-between mt-8">
                    {{-- Link "Già Registrato?" con classi Tailwind/Breeze --}}
                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                        href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    {{-- Bottone Registrazione (Stile Manual Login) --}}
                    <button
                        class="inline-flex justify-center items-center px-4 py-2 bg-indigo-600 border border-transparent
                            rounded-lg font-semibold text-xs text-white uppercase tracking-widest
                            hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2
                            focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-lg ms-4">
                        Registrati
                    </button>
                </div>
            </form>
        </div>
    </div>


@endsection
