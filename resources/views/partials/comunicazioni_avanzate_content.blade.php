<div class="p-6 lg:p-8 bg-white shadow-xl rounded-lg border border-gray-100">
    {{-- HEADLINE per la lezione --}}
    <h1 class="text-4xl font-extrabold mb-8 text-gray-800 border-b-4 border-indigo-200 pb-4">
        🚀 Code Avanzate, Notifiche e Supervisor (Scalabilità in Produzione)
    </h1>

    <div class="space-y-16">

        {{-- SEZIONE 1: MAILABLES E NOTIFICHE --}}
        <div class="border-l-4 border-indigo-600 pl-6 bg-indigo-50 p-4 rounded-lg">
            <h2 class="text-2xl font-extrabold text-indigo-700 mb-4">
                Parte 1: Mailable vs. Notifiche (Il "Chi" e il "Come" della Comunicazione)
            </h2>
            <p class="text-lg text-gray-700 mb-4">
                Questi sistemi separano la creazione del messaggio dal suo invio. La differenza chiave è: le **Mailable** sono focalizzate sulla singola email, mentre le **Notifiche** sono multi-canale e associate a un destinatario.
            </p>

            <div class="mt-8 space-y-6">
                <h3 class="text-xl font-bold text-gray-800 border-b pb-2">Notifiche Multi-Canale (La Potenza del `Notifiable`)</h3>
                <ul class="list-none space-y-4">
                    <li class="p-3 bg-white rounded-md shadow-sm">
                        <strong class="text-indigo-600">Canali (`via()`):</strong>
                        Definisce i canali di consegna (es. `['mail', 'database']`). La flessibilità permette di inviare lo stesso messaggio su più piattaforme.
                        <pre class="bg-gray-700 text-yellow-300 p-2 mt-2 rounded-md text-sm"><code>
// Nella Notifica:
public function via(object $notifiable): array
{
    // Se l'utente ha un token Slack, invia anche lì!
    return $notifiable->prefers_slack ? ['mail', 'slack'] : ['mail', 'database'];
}
                        </code></pre>
                    </li>
                    <li class="p-3 bg-white rounded-md shadow-sm">
                        <strong class="text-indigo-600">Database (`toDatabase()`):</strong>
                        Permette di salvare il payload in una tabella `notifications` (che devi creare con `php artisan notifications:table` e migrare). Essenziale per i centri notifiche in-app.
                        <pre class="bg-gray-700 text-yellow-300 p-2 mt-2 rounded-md text-sm"><code>
public function toDatabase(object $notifiable): array
{
    // I dati sono serializzati e salvati nella colonna 'data'
    return [
        'titolo' => 'Nuovo Messaggio',
        'risorsa_id' => $this->message->id,
    ];
}
                        </code></pre>
                    </li>
                </ul>
            </div>
        </div>

        <hr class="my-12 border-gray-300">

        {{-- SEZIONE 2: CODE E JOBS (Il Cuore della Velocità) --}}
        <div class="border-l-4 border-green-600 pl-6 bg-green-50 p-4 rounded-lg">
            <h2 class="text-2xl font-extrabold text-green-700 mb-4">
                Parte 2: Messa in Coda e Jobs (Resilienza e Zero Downtime)
            </h2>
            <p class="text-lg text-gray-700 mb-4">
                Un **Job** è una singola unità di lavoro in background. L'obiettivo è liberare l'utente da attese lunghe durante l'elaborazione di email, upload o report complessi.
            </p>

            <div class="mt-8 space-y-6">
                <h3 class="text-xl font-bold text-gray-800 border-b pb-2">Configurazione, Resilienza e Fallimenti</h3>
                <ul class="list-none space-y-4">
                    <li class="p-3 bg-white rounded-md shadow-sm">
                        <strong class="text-green-600">Invio Messa in Coda:</strong>
                        L'invio a una coda è implicito se la Notifica/Mailable usa il trait `ShouldQueue`, oppure esplicito:
                        <pre class="bg-gray-700 text-yellow-300 p-2 mt-2 rounded-md text-sm"><code>
// Invia il Job alla coda predefinita
ProcessPodcast::dispatch($podcast);
                        </code></pre>
                    </li>
                    <li class="p-3 bg-white rounded-md shadow-sm">
                        <strong class="text-green-600">Tipi di Coda (Connection):</strong>
                        Determina dove i Job vengono archiviati:
                        <ul>
                            <li><strong class="font-semibold">`sync` (Default Sviluppo):</strong> Esegue il Job immediatamente (non usa la coda).</li>
                            <li><strong class="font-semibold">`database` (Sviluppo/Piccola Prod.):</strong> Salva i Job nella tabella `jobs`.</li>
                            <li><strong class="font-semibold">`redis` o `sqs` (Produzione):</strong> Soluzioni ad alte prestazioni per le code.</li>
                        </ul>
                    </li>
                    <li class="p-3 bg-white rounded-md shadow-sm">
                        <strong class="text-green-600">Worker Command (Resilienza):</strong>
                        Il comando Worker deve definire come gestire errori e durata:
                        <pre class="bg-gray-700 text-yellow-300 p-2 mt-2 rounded-md text-sm"><code>
php artisan queue:work database --sleep=3 --tries=3 --timeout=60
// --sleep=3: attesa tra un Job e l'altro in secondi
// --tries=3: 3 tentativi prima di fallire definitivamente
// --timeout=60: il Worker deve terminare il Job entro 60 secondi
                        </code></pre>
                    </li>
                </ul>
            </div>
        </div>

        <hr class="my-12 border-gray-300">

        {{-- SEZIONE 3: SUPERVISOR (Monitoraggio e Deploy) --}}
        <div class="border-l-4 border-red-600 pl-6 bg-red-50 p-4 rounded-lg">
            <h2 class="text-2xl font-extrabold text-red-700 mb-4">
                Parte 3: Supervisor (Implementazione e Debug WSL)
            </h2>
            <p class="text-lg text-gray-700 mb-4">
                Supervisor è un demone di sistema Linux che garantisce che il Worker sia **sempre UP**. Risolve i problemi di crash, morte del processo o riavvii del server.
            </p>

            <div class="mt-8 space-y-6">
                <h3 class="text-xl font-bold text-gray-800 border-b pb-2">Punti Critici di Configurazione e Debug</h3>
                <ul class="list-none space-y-4">
                    <li class="p-3 bg-white rounded-md shadow-sm">
                        <strong class="text-red-600">L'Ostacolo Principale (WSL/Linux):</strong>
                        La causa più comune degli errori `BACKOFF` è la mancanza di PHP o una versione errata nell'ambiente WSL, o problemi di contesto.
                        <pre class="bg-gray-700 text-yellow-300 p-2 mt-2 rounded-md text-sm"><code>
# 1. ERRORE VERSIONE PHP (il più recente per te)
Your Composer dependencies require a PHP version ">= 8.2.0". You are running 8.1.33.
# SOLUZIONE: Installare PHP 8.2 in WSL e impostarlo come default con update-alternatives.

# 2. ERRORE DI PERMESSI/DIRECTORY (risolto)
# SOLUZIONE: Assicurarsi che nel file .conf ci sia la riga:
directory=/mnt/d/PROGETTI/LARAVEL/eventi_schedulazione

# 3. ERRORE DI PERMESSI DI SCRITTURA
# SOLUZIONE: Assicurarsi che l'utente 'marco' possa scrivere:
sudo chown -R marco:marco storage bootstrap/cache
                        </code></pre>
                    </li>
                    <li class="p-3 bg-white rounded-md shadow-sm">
                        <strong class="text-red-600">Ciclo di Gestione Supervisor:</strong>
                        Per applicare *qualsiasi* modifica al file `.conf`, devi seguire un ciclo preciso per evitare l'errore "job is already started":
                        <pre class="bg-gray-700 text-yellow-300 p-2 mt-2 rounded-md text-sm"><code>
sudo supervisorctl stop laravel-worker
sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl start laravel-worker
sudo supervisorctl status
                        </code></pre>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
