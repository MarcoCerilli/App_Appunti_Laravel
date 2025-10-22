<div class="p-6 lg:p-8 bg-white shadow-xl rounded-lg border border-gray-100">
    {{-- HEADLINE per la lezione --}}
    <h1 class="text-3xl font-bold mb-8 text-gray-800 border-b pb-4">
        💾 Gestione Avanzata: Storage, Sessioni & Cache
    </h1>

    <div class="space-y-12">

        {{-- SEZIONE 1: INTRODUZIONE AL FILESYSTEM (STORAGE) --}}
        <div class="border-l-4 border-indigo-500 pl-4">
            <h2 class="text-2xl font-extrabold text-indigo-700 mb-4">
                Parte 1: Laravel Filesystem (Storage)
            </h2>
            <p class="text-lg text-gray-600 mb-4">
                Laravel fornisce un'astrazione potente e unificata per la gestione dei filesystem, basata sul pacchetto
                <a href="https://flysystem.thephpleague.com/" target="_blank"
                    class="text-indigo-500 hover:text-indigo-700 underline font-semibold">
                    Flysystem</a> di Frank de Jonge. Questo permette di interagire con storage locali o cloud (come S3)
                utilizzando le stesse API.
            </p>

            <div class="mt-6 space-y-4">
                <h3 class="text-xl font-semibold text-gray-700">Driver e Configurazione</h3>
                <p class="text-gray-700">
                    I **Driver** definiscono dove i file verranno archiviati. I driver predefiniti sono `local`
                    (storage/app) e `public` (storage/app/public, accessibile via URL dopo `php artisan storage:link`).
                </p>
                <pre class="bg-gray-700 text-yellow-300 p-3 rounded-md overflow-x-auto text-sm"><code>
// Configurazione in config/filesystems.php

'disks' => [
    'local' => [
        'driver' => 'local',
        'root' => storage_path('app'),
    ],

    'public' => [
        'driver' => 'local',
        'root' => storage_path('app/public'),
        'url' => env('APP_URL').'/storage',
        'visibility' => 'public', // Permette l'accesso pubblico
    ],
    // ... 's3' e altri driver cloud
],
                    </code></pre>
            </div>

            <div class="mt-6 space-y-4">
                <h3 class="text-xl font-semibold text-gray-700">Archiviazione, Recupero e Manipolazione</h3>
                <p class="text-gray-700">
                    Usiamo la Facade `Storage` per tutte le operazioni. Il metodo `put()` salva il contenuto, mentre
                    `get()` lo recupera.
                </p>
                <pre class="bg-gray-700 text-yellow-300 p-3 rounded-md overflow-x-auto text-sm"><code>
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

// Archiviazione (put è per il contenuto, store è per i file uploadati)
Storage::disk('public')->put('esempio/mio_file.txt', 'Contenuto del file...');

// Archiviazione di un file caricato (dinamico)
// $path è il nome del file generato
$path = $request->file('avatar')->store('avatars', 'public');

// Recupero
$contents = Storage::get('file.txt');

// Manipolazione e Download
$exists = Storage::disk('public')->exists('logo.png'); // Verifica esistenza
Storage::delete('vecchio_file.txt'); // Elimina
return Storage::download('documenti/manuale.pdf'); // Forzare il download

// Directory
$files = Storage::directories('logs'); // Ottieni le cartelle
                    </code></pre>
            </div>
        </div>

        <hr class="my-10">

        {{-- SEZIONE 2: SESSIONI E CACHE --}}
        <div class="border-l-4 border-green-500 pl-4">
            <h2 class="text-2xl font-extrabold text-green-700 mb-4">
                Parte 2: Sessioni e Cache in Laravel
            </h2>
            <p class="text-lg text-gray-600 mb-4">
                Sessioni e Cache gestiscono i dati temporanei, ma hanno scopi diversi: le **Sessioni** sono specifiche
                dell'utente, mentre la **Cache** è tipicamente un archivio di dati globale (o semi-globale) per
                migliorare le performance.
            </p>

            <div class="mt-6 space-y-4">
                <h3 class="text-xl font-semibold text-gray-700">Sessioni</h3>
                <p class="text-gray-700">
                    Le sessioni permettono di persistere i dati tra le richieste di un singolo utente. Si può accedere
                    tramite `session()` helper o la Facade `Session`.
                </p>
                <ul class="list-disc list-inside space-y-2 ml-4 text-gray-700">
                    <li>
                        <strong class="text-green-600">Push & Pull (Manipolazione):</strong>
                        <pre class="bg-gray-700 text-yellow-300 p-2 mt-1 rounded-md text-sm"><code>
session(['carrello' => $prodotto]); // Imposta
$prodotto = session('carrello');    // Recupera
session()->push('ordini', $nuovoOrdine); // Aggiunge a un array in sessione
$value = session()->pull('temp_key'); // Recupera ed elimina immediatamente
                        </code></pre>
                    </li>
                    <li>
                        <strong class="text-green-600">Flash Data:</strong> Dati che persistono per **una sola richiesta
                        HTTP aggiuntiva** (utili per messaggi di stato, es. "Elemento aggiunto con successo!").
                        <pre class="bg-gray-700 text-yellow-300 p-2 mt-1 rounded-md text-sm"><code>
return redirect('/dashboard')->with('status', 'Operazione completata!');
// Nella vista successiva: {{ session('status') }}
                        </code></pre>
                    </li>
                </ul>
            </div>

            <div class="mt-6 space-y-4">
                <h3 class="text-xl font-semibold text-gray-700">Cache</h3>
                <p class="text-gray-700">
                    La Cache è usata per memorizzare i risultati di operazioni costose (query al database, calcoli
                    complessi) e recuperarli velocemente.
                </p>
                <ul class="list-disc list-inside space-y-2 ml-4 text-gray-700">
                    <li>
                        <strong class="text-green-600">Impostazione e Recupero:</strong>
                        <pre class="bg-gray-700 text-yellow-300 p-2 mt-1 rounded-md text-sm"><code>
use Illuminate\Support\Facades\Cache;

// Memorizza per 60 minuti
Cache::put('users_list', $users, 60 * 60);

// Recupera
$users = Cache::get('users_list');

// Recupera o memorizza (più comune: se esiste lo prende, altrimenti esegue la closure e lo salva)
$users = Cache::remember('users_list_full', 60 * 60, function () {
    return User::all(); // Query pesante
});

Cache::forget('old_key'); // Elimina
                        </code></pre>
                    </li>
                </ul>
            </div>
        </div>

    </div>
</div>
