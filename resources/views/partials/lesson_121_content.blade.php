<div class="lesson-content space-y-8">

    {{-- INTRODUZIONE --}}
    <div class="text-left mb-8">
        <h2 class="text-4xl font-extrabold text-indigo-700 mb-4">
            Separare Accesso (Middleware) e Contenuto (Controller)
        </h2>
        <p class="text-lg text-gray-600 max-w-4xl">
            Quando gestiamo aree protette (come <code>/admin</code>), possiamo scegliere di bloccare l'accesso in modo **rigido** (Middleware) oppure gestirlo in modo **flessibile** (Controller/View). L'approccio flessibile ci permette di mostrare all'utente una pagina personalizzata di "Accesso Negato" senza reindirizzarlo.
        </p>
        <hr class="my-6 border-indigo-200">
    </div>

    {{-- SEZIONE 1: Il Modello Classico (Rigido) --}}
    <h3 class="text-2xl font-semibold text-gray-700 border-l-4 border-red-500 pl-3">
        1. Il Modello Rigido: Middleware di Autorizzazione
    </h3>
    <p class="text-gray-700">
        Questo approccio è semplice: se l'utente non ha il permesso, la richiesta viene **intercettata prima di raggiungere il Controller**. Laravel lancia un'eccezione 403 (Accesso Negato) e l'utente viene immediatamente reindirizzato alla pagina di errore standard (o, in mancanza, alla pagina 403).
    </p>

    <div class="bg-gray-100 p-4 rounded-lg shadow-inner">
        <h4 class="text-xl font-bold text-gray-700 mb-2">Esempio: Middleware Rigido in <code>routes/web.php</code></h4>
        <pre class="bg-gray-700 text-yellow-300 p-2 mt-2 rounded-md overflow-x-auto text-sm"><code>
Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    // Se l'utente non è 'admin', NON raggiungerà MAI l'index
    Route::get('/admin', [AdminController::class, 'index'])
        ->name('admin.index');
});
        </code></pre>
        <p class="text-sm text-red-700 mt-2 font-medium">
            ⚠️ **Problema:** L'utente non ha controllo sulla vista di errore mostrata, o viene reindirizzato, perdendo il contesto della pagina <code>/admin</code>.
        </p>
    </div>

    {{-- SEZIONE 2: Il Modello Flessibile (Separato) --}}
    <h3 class="text-2xl font-semibold text-gray-700 pt-6 border-l-4 border-green-500 pl-3">
        2. Il Modello Flessibile: Controllo nel Controller
    </h3>
    <p class="text-gray-700">
        Questa strategia separa i due controlli:
    </p>
    <ul class="list-disc list-inside space-y-2 ml-4 text-gray-700">
        <li>
            <strong class="text-indigo-600">Accesso (Middleware):</strong> La rotta è protetta solo da <code>auth</code> e <code>verified</code>. Chiunque sia loggato e verificato può *raggiungere* il Controller.
        </li>
        <li>
            <strong class="text-indigo-600">Contenuto (Controller):</strong> Il Controller usa il Gate per decidere *cosa mostrare* all'interno della vista, personalizzando il messaggio di successo o di errore.
        </li>
    </ul>

    <div class="bg-green-50 p-4 rounded-lg shadow-inner">
        <h4 class="text-xl font-bold text-green-700 mb-2">Esempio: Middleware Flessibile in <code>routes/web.php</code></h4>
        <pre class="bg-gray-700 text-yellow-300 p-2 mt-2 rounded-md overflow-x-auto text-sm"><code>
Route::middleware(['auth', 'verified'])->group(function () {
    // Tutti gli utenti loggati/verificati raggiungono l'index
    Route::get('/admin', [AdminController::class, 'index'])
        ->name('admin.index');
});
        </code></pre>
        <p class="text-sm text-green-700 mt-2 font-medium">
            ✅ **Vantaggio:** L'utente rimane sulla rotta <code>/admin</code> e possiamo mostrargli un messaggio di Accesso Negato **personalizzato** all'interno della view.
        </p>
    </div>


    {{-- SEZIONE 3: Il Controller come Arbitro --}}
    <h3 class="text-2xl font-semibold text-gray-700 pt-6 border-l-4 border-indigo-500 pl-3">
        3. Caso Pratico: Il Controller come Arbitro del Contenuto
    </h3>
    <p class="text-gray-700">
        Il Controller ora agisce come un arbitro, utilizzando <code>Gate::allows()</code> per determinare le variabili di stato (titolo, messaggio, colore) da passare alla vista.
    </p>

    <div class="bg-yellow-50 p-4 rounded-lg shadow-inner">
        <h4 class="text-xl font-bold text-yellow-800 mb-2">Logica Chiave nel Controller</h4>
        <p class="text-sm text-gray-800 mb-3">
            Notare come le variabili vengono inizializzate con i valori di "Accesso Negato" e sovrascritte solo se il <code>Gate::allows('admin')</code> è positivo.
        </p>
        <pre class="bg-gray-700 text-yellow-300 p-2 mt-2 rounded-md overflow-x-auto text-sm"><code>
// Inizializza con i valori di Accesso Negato (default)
$isAdmin = false;
$messageTitle = 'Area Riservata: Accesso Negato';
$statusClass = 'bg-red-100...';

if (Gate::allows('admin')) {
    // Sovrascrivi se l'utente è ADMIN
    $isAdmin = true;
    $messageTitle = 'Area di Amministrazione Protetta';
    $statusClass = 'bg-green-100...';
}

return view('admin.dashboard', [
    // ... passa tutte le variabili alla vista
]);
        </code></pre>
    </div>

</div>
