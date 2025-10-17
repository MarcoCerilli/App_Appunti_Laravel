{{-- CONTENUTO LEZIONE: Service Providers e Architettura di Laravel (Base Teorica) --}}
<div class="lesson-content space-y-8">

    {{-- INTRODUZIONE --}}
    <div class="text-left mb-8">
        <h2 class="text-4xl font-extrabold text-indigo-700 mb-4">Service Providers e il Cuore di Laravel</h2>
        <p class="text-lg text-gray-600 max-w-4xl">
            I **Service Providers** non sono solo file di configurazione; sono la spina dorsale dell'architettura di Laravel, i punti centrali da cui l'intera applicazione viene avviata e gestita. Capire il loro ruolo è fondamentale per qualsiasi debug avanzato.
        </p>
        <hr class="my-6 border-indigo-200">
    </div>

    {{-- SEZIONE 1: Cos'è un Service Provider --}}
    <h3 class="text-2xl font-semibold text-gray-700 border-l-4 border-indigo-500 pl-3">
        1. Il Ruolo del Service Provider
    </h3>
    <p class="text-gray-700">
        I Service Providers sono i **"configuratori"** dell'applicazione. Quasi tutte le funzionalità di Laravel (Routing, Database, Validazione, il sistema di Autenticazione) vengono inizializzate e messe a disposizione (registrate) tramite un Provider.
    </p>
    <p class="text-gray-700 mt-2">
        **L'obiettivo:** Insegnare al framework come costruire e caricare i suoi servizi.
    </p>

    {{-- SEZIONE 2: Il Service Container --}}
    <h3 class="text-2xl font-semibold text-gray-700 pt-6 border-l-4 border-indigo-500 pl-3">
        2. Il Concetto Fondamentale: Il Service Container (IoC)
    </h3>
    <p class="text-gray-700">
        I Providers lavorano a stretto contatto con il **Service Container** (o IoC - *Inversion of Control* Container).  Questo è una "super-scatola" che gestisce la creazione di tutte le classi e le loro dipendenze.
    </p>

    <ul class="list-disc list-inside space-y-2 ml-4 text-gray-700">
        <li>
            <strong class="text-indigo-600">Registrazione:</strong> Il Provider *registra* un servizio, dicendo al Container: "Quando qualcuno ha bisogno della classe X, ecco come devi fornirla."
        </li>
        <li>
            <strong class="text-indigo-600">Risoluzione (Dependency Injection):</strong> Il Container *risolve* automaticamente la dipendenza (creando l'oggetto richiesto) e la *inietta* dove serve (ad esempio, nel costruttore di un controller).
        </li>
    </ul>

    {{-- SEZIONE 3: I Metodi Chiave --}}
    <h3 class="text-2xl font-semibold text-gray-700 pt-6 border-l-4 border-indigo-500 pl-3">
        3. I Metodi `register()` e `boot()`
    </h3>
    <p class="text-gray-700">
        Ogni Service Provider personalizzato (come `AuthServiceProvider`) ha due metodi eseguiti in momenti diversi del ciclo di vita di Laravel:
    </p>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
        {{-- register() --}}
        <div class="bg-indigo-50 p-4 rounded-lg shadow">
            <h4 class="text-xl font-bold text-indigo-700 mb-2">Il Metodo `register()`</h4>
            <p class="text-sm text-gray-800">
                Usato per **legare (bind)** servizi al Container. Qui si definisce "cosa esiste". Non si devono usare servizi, ma solo registrarli.
            </p>
            <pre class="bg-gray-700 text-yellow-300 p-2 mt-2 rounded-md overflow-x-auto text-xs"><code>
public function register(): void
{
    // Esempio: Registrare un'interfaccia con un'implementazione
    $this->app->bind(
        'App\Contracts\ServiceA',
        'App\Services\ServiceAImpl'
    );
}
            </code></pre>
        </div>

        {{-- boot() --}}
        <div class="bg-green-50 p-4 rounded-lg shadow">
            <h4 class="text-xl font-bold text-green-700 mb-2">Il Metodo `boot()`</h4>
            <p class="text-sm text-gray-800">
                Eseguito **DOPO** che tutti i `register()` sono stati completati. Qui si usa l'applicazione per configurare le cose.
            </p>
            <ul class="list-disc list-inside space-y-1 ml-4 text-sm text-gray-800">
                <li>Definire Rotte.</li>
                <li>**Definire Gates e Policies** (il nostro caso).</li>
                <li>Registrare View Composers.</li>
            </ul>
        </div>
    </div>


    {{-- SEZIONE 4: Caso Pratico: Il Nostro Errore --}}
    <h3 class="text-2xl font-semibold text-gray-700 pt-6 border-l-4 border-indigo-500 pl-3">
        4. Caso Pratico: La Mancata Registrazione
    </h3>
    <p class="text-gray-700">
        Nel nostro caso, la Gate era definita nel metodo `boot()` di `AuthServiceProvider`. L'errore è avvenuto perché il provider **non era elencato** nell'array `'providers'` del file <code>config/app.php</code>.
    </p>

    <p class="text-gray-700 mt-2 p-3 bg-red-50 border-l-4 border-red-400">
        Se un Provider non è registrato in <code>config/app.php</code>, Laravel lo ignora completamente. Di conseguenza, il suo metodo <code>boot()</code> (che conteneva la nostra logica <code>Gate::define</code>) **non è mai stato chiamato**, e l'autorizzazione è rimasta inattiva.
    </p>

</div>
