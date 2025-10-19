@extends('layouts.guest')

@section('content')
<div class="p-6 bg-white border-b border-gray-200">
    <h1 class="text-3xl font-bold text-indigo-700">Area di Amministrazione Protetta</h1>

    <p class="mt-4">Se vedi questa pagina, hai superato sia il Middleware che il Gate.</p>

    {{-- Questo è il controllo di sicurezza finale a livello di Blade --}}
    @can('access-admin')
        <div class="mt-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
            <strong>🟢 ADMIN: Accesso Garantito dal Gate!</strong>
            <p>Qui puoi caricare i contenuti riservati solo all'Amministratore.</p>
        </div>
    @else
        <div class="mt-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
            <strong>🔴 UTENTE: Accesso bloccato dal Gate!</strong>
            <p>Se vedi questo, qualcosa non ha funzionato nel Middleware, ma il Gate ti ha fermato in tempo.</p>
        </div>
    @endcan
</div>
@endsection
