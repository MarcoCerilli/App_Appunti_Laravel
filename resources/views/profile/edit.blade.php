<x-app-layout>
    {{-- HEADER: Verrà inserito nel blocco $header del tuo layouts/app.blade.php --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profilo Utente') }}
        </h2>
    </x-slot>

    {{--
        CONTENUTO PRINCIPALE ($slot):
        Sostituiamo le classi di spaziatura verticali (py-12) e il contenitore massimo
        perché il layout è già gestito da .main-content nel layout padre.
    --}}

    {{-- Rimosso py-12 --}}
    <div>
        {{-- Rimosso max-w-7xl, lasciando mx-auto e spaziatura laterale sm:px-6 lg:px-8 --}}
        <div class="mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- SEZIONE 1: Aggiorna Profilo --}}
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            {{-- SEZIONE 2: Aggiorna Password --}}
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            {{-- SEZIONE 3: Elimina Utente --}}
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
