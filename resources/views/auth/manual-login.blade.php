@extends('layouts.app')

@section('content')

    {{-- Aggiunta la variabile per forzare il layout a larghezza intera, nascondendo la sidebar --}}
    @php $isAuthPage = true; @endphp

    {{-- Le classi di centratura (come flex-col items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900 min-h-screen)
         sono state rimosse dal layout principale (layouts/app.blade.php) e gestite dalla <main> per le pagine Auth.
         Quindi, qui mantieni solo la card del form. --}}

    <div class="sm:max-w-md px-6 py-8 bg-white dark:bg-gray-800 shadow-2xl overflow-hidden sm:rounded-xl">
        <h2 class="text-3xl font-extrabold text-gray-900 dark:text-gray-100 text-center mb-8 border-b pb-4">
            Accedi Manualmente (Lezione 95)
        </h2>

        {{-- Session Status --}}
        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                {{ session('status') }}
            </div>
        @endif

        {{-- Visualizzazione errori di validazione (generici o specifici) --}}
        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                @foreach ($errors->all() as $error)
                    <p class="text-sm">{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('manual.login') }}">
            @csrf

            {{-- Email Address --}}
            <div class="mt-4">
                <label for="email" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Email</label>
                <input id="email"
                    class="block mt-1 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200
                                focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm"
                    type="email" name="email" value="{{ old('email') }}" required autofocus />
                {{-- Messaggio di errore per Email --}}
                @error('email')
                    <p class="text-sm text-red-600 dark:text-red-400 mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password --}}
            <div class="mt-6">
                <label for="password" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Password</label>
                <input id="password"
                    class="block mt-1 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200
                                focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm"
                    type="password" name="password" required autocomplete="current-password" />
                {{-- Messaggio di errore per Password --}}
                @error('password')
                    <p class="text-sm text-red-600 dark:text-red-400 mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-end mt-8">
                <button
                    class="w-full inline-flex justify-center items-center px-4 py-2 bg-indigo-600 border border-transparent
                                rounded-lg font-semibold text-xs text-white uppercase tracking-widest
                                hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2
                                focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-lg">
                    Accedi Manualmente
                </button>
            </div>
        </form>
    </div>
@endsection
