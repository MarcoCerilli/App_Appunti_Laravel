<h1 class="text-2xl font-bold mb-4 text-gray-800">Esercizi sui Condizionali Blade</h1>
<p class="mb-6 text-gray-600">
    Questi esempi mostrano come Blade gestisce le condizioni logiche in base alle variabili passate dalla
    Route (<code>$logged_in</code>, <code>$username</code>, <code>$user_role</code>, <code>$empty_list</code>).
</p>

{{-- ------------------------------------------------------------------------------------------------ --}}

{{-- CARD: Sostituisce .card.mb-4.shadow-sm --}}
<div class="bg-white mb-6 shadow-lg rounded-lg overflow-hidden">
    {{-- CARD HEADER (PRIMARY/BLU): Sostituisce .card-header.bg-primary.text-white --}}
    <div class="p-4 text-white font-semibold" style="background-color: #6c5ce7;">
        1. Direttiva @@if / @@elseif / @@else
    </div>

    {{-- CARD BODY: Sostituisce .card-body --}}
    <div class="p-6">
        <h5 class="text-xl font-bold mb-3 text-gray-800">Verifica Ruolo Utente e Login</h5>
        <p class="mb-4 text-sm font-mono bg-gray-100 p-2 rounded">
            <strong>Variabile di test:</strong>
            <code>$user_role</code> = <code>{{ $user_role }}</code> |
            <code>$logged_in</code> = <code>{{ $logged_in ? 'Vero' : 'Falso' }}</code>
        </p>

        {{-- LOGICA --}}
        @if ($user_role == 'admin')
            {{-- ALERT SUCCESS: Sostituisce .alert.alert-success --}}
            <div class="p-4 bg-emerald-100 text-emerald-800 border-l-4 border-emerald-500 rounded" role="alert">
                Benvenuto, **{{ $username }}**! Sei un **Amministratore**.
            </div>
        @elseif ($user_role == 'editor' && $logged_in)
            {{-- ALERT INFO: Sostituisce .alert.alert-info --}}
            <div class="p-4 bg-blue-100 text-blue-800 border-l-4 border-blue-500 rounded" role="alert">
                Ciao, **{{ $username }}**. Sei un **Editor** registrato.
            </div>
        @else
            {{-- ALERT WARNING: Sostituisce .alert.alert-warning --}}
            <div class="p-4 bg-yellow-100 text-yellow-800 border-l-4 border-yellow-500 rounded" role="alert">
                Accesso limitato. Sei un semplice utente o non sei loggato.
            </div>
        @endif
    </div>
</div>

{{-- ------------------------------------------------------------------------------------------------ --}}

{{-- CARD: Sostituisce .card.mb-4.shadow-sm --}}
<div class="bg-white mb-6 shadow-lg rounded-lg overflow-hidden">
    {{-- CARD HEADER (SUCCESS/VERDE): Sostituisce .card-header.bg-success.text-white --}}
    <div class="p-4 text-white font-semibold" style="background-color: #00b894;">
        2. Direttiva @@unless
    </div>

    {{-- CARD BODY: Sostituisce .card-body --}}
    <div class="p-6">
        <h5 class="text-xl font-bold mb-3 text-gray-800">@@unless - Esegue il blocco se la condizione è **FALSA**</h5>
        <p class="mb-4 text-sm font-mono bg-gray-100 p-2 rounded">
            <strong>Variabile di test:</strong>
            <code>$logged_in</code> = <code>{{ $logged_in ? 'Vero' : 'Falso' }}</code>
        </p>

        {{-- LOGICA --}}
        @unless ($logged_in)
            {{-- ALERT DANGER: Sostituisce .alert.alert-danger --}}
            <div class="p-4 bg-red-100 text-red-800 border-l-4 border-red-500 rounded" role="alert">
                Devi effettuare il login per accedere (attualmente **NON** loggato).
            </div>
        @else
            {{-- ALERT SUCCESS --}}
            <div class="p-4 bg-emerald-100 text-emerald-800 border-l-4 border-emerald-500 rounded" role="alert">
                L'utente è loggato. Il blocco `@@unless` è stato saltato.
            </div>
        @endunless
    </div>
</div>

{{-- ------------------------------------------------------------------------------------------------ --}}

{{-- CARD: Sostituisce .card.mb-4.shadow-sm --}}
<div class="bg-white mb-6 shadow-lg rounded-lg overflow-hidden">
    {{-- CARD HEADER (INFO/AZZURRO): Sostituisce .card-header.bg-info.text-white --}}
    <div class="p-4 text-white font-semibold" style="background-color: #00b894;">
        3. Direttive @@isset / @@empty
    </div>

    {{-- CARD BODY: Sostituisce .card-body --}}
    <div class="p-6">
        <h5 class="text-xl font-bold mb-3 text-gray-800">Controllo Esistenza e Contenuto delle Variabili</h5>

        {{-- LAYOUT A DUE COLONNE: Sostituisce .row.col-md-6 --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            {{-- COLONNA 1 --}}
            <div>
                <h6 class="text-lg font-semibold mb-2 text-gray-700">@@isset($username) - Controlla se la variabile è definita e non NULL</h6>
                @isset($username)
                    {{-- ALERT PRIMARY: Sostituisce .alert.alert-primary --}}
                    <div class="p-4 bg-indigo-100 text-indigo-800 border-l-4 border-indigo-500 rounded" role="alert">
                        La variabile <code>$username</code> è definita e ha valore: **{{ $username }}**.
                    </div>
                @endisset
            </div>

            {{-- COLONNA 2 --}}
            <div>
                <h6 class="text-lg font-semibold mb-2 text-gray-700">@@empty($empty_list) - Controlla se una variabile è vuota</h6>
                @empty($empty_list)
                    {{-- ALERT SECONDARY: Sostituisce .alert.alert-secondary --}}
                    <div class="p-4 bg-gray-100 text-gray-800 border-l-4 border-gray-500 rounded" role="alert">
                        La lista <code>$empty_list</code> è vuota!
                    </div>
                @else
                    {{-- ALERT DANGER --}}
                    <div class="p-4 bg-red-100 text-red-800 border-l-4 border-red-500 rounded" role="alert">
                        La lista <code>$empty_list</code> contiene elementi.
                    </div>
                @endempty
            </div>
        </div>
    </div>
</div>
