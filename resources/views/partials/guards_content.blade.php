{{-- CONTENUTO LEZIONE: Utilizziamo classi Tailwind --}}
<div class="lesson-content space-y-8">

    {{-- INTRODUZIONE --}}
    <div class="text-left mb-8">
        <h2 class="text-4xl font-extrabold text-indigo-700 mb-4">Guards e Providers</h2>
        <p class="text-lg text-gray-600 max-w-4xl">
            L'**Autenticazione** in Laravel è gestita da due componenti chiave: i **Guards** (il *come* un utente è loggato) e i **Providers** (il *dove* l'utente viene recuperato). Per le lezioni 97-100, costruiremo un **Custom Guard** che gestisce l'autenticazione in modo non convenzionale.
        </p>
        <hr class="my-6 border-indigo-200">
    </div>

    {{-- SEZIONE 1: Configurazione di Base --}}
    <h3 class="text-2xl font-semibold text-gray-700 border-l-4 border-indigo-500 pl-3">
        1. Configurazione: Dichiarare il Custom Guard
    </h3>
    <p class="text-gray-700">
        Per creare un Guard personalizzato, dobbiamo prima registrarlo nel file <code>config/auth.php</code>. Lo chiameremo **'token_static'** e useremo un driver personalizzato.
    </p>

    <h4 class="text-xl font-medium text-gray-600 mt-6 mb-3">Modifica <code>config/auth.php</code>:</h4>
    <pre class="bg-gray-900 text-green-400 p-4 rounded-lg overflow-x-auto shadow-inner text-sm"><code>
// ...
'guards' => [
    'web' => [
        'driver' => 'session',
        'provider' => 'users',
    ],
    // Aggiungi il nostro Custom Guard qui (Lezione 97)
    'token_static' => [
        'driver' => 'static', // Useremo un driver chiamato 'static'
        'provider' => 'users', // Useremo il Provider standard 'users'
    ],
],
// ...
</code></pre>

    {{-- SEZIONE 2: Implementazione del Custom Guard (Lezioni 98-99) --}}
    <h3 class="text-2xl font-semibold text-gray-700 pt-6 border-l-4 border-indigo-500 pl-3">
        2. Implementazione: Creare la Logica del Guard
    </h3>
    <p class="text-gray-700">
        Un Custom Guard deve implementare l'interfaccia <code>Illuminate\Contracts\Auth\Guard</code>. Creeremo una classe per gestire l'autenticazione basata su un token statico passato nell'header HTTP.
    </p>

    <h4 class="text-xl font-medium text-gray-600 mt-6 mb-3">Crea <code>app/Guards/StaticTokenGuard.php</code>:</h4>
    <p class="text-sm italic text-red-600">
        <span class="font-bold">ATTENZIONE:</span> Devi creare la directory `app/Guards` e poi questo file.
    </p>

    <pre class="bg-gray-900 text-green-400 p-4 rounded-lg overflow-x-auto shadow-inner text-sm"><code>
{{-- Codice del StaticTokenGuard.php da implementare nel file --}}
&lt;?php

namespace App\Guards;

use Illuminate\Http\Request;
use Illuminate\Auth\GuardHelpers;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\UserProvider;

class StaticTokenGuard implements Guard
{
    use GuardHelpers;

    protected $request;
    protected $provider;

    // Il token statico che useremo per il test (solo per didattica)
    const STATIC_TOKEN = 'MY_SECRET_STATIC_TOKEN_123';

    public function __construct(UserProvider $provider, Request $request)
    {
        $this->request = $request;
        $this->provider = $provider;
    }

    /**
     * Recupera l'utente autenticato per la richiesta.
     */
    public function user()
    {
        // Se l'utente è già stato caricato, restituiscilo
        if (! is_null($this->user)) {
            return $this->user;
        }

        // 1. Cerca il token nell'header 'X-Static-Token'
        $token = $this->request->header('X-Static-Token');

        // 2. Controlla se il token fornito corrisponde al nostro token statico
        if ($token === self::STATIC_TOKEN) {

            // 3. Se il token corrisponde, carica l'utente di ID 1
            // In un'app reale, cercheresti l'utente in base al token nel database.
            return $this->user = $this->provider->retrieveById(1); // Recupera l'utente 1 dal database
        }

        return $this->user = null;
    }

    // Le altre funzioni richieste dall'interfaccia Guard:

    public function validate(array $credentials = [])
    {
        // Non usiamo credenziali con questo Guard, ma è necessario per l'interfaccia
        if (isset($credentials['token']) && $credentials['token'] === self::STATIC_TOKEN) {
            return true;
        }
        return false;
    }

    // Questi metodi sono necessari per l'interfaccia ma inutilizzati in un Guard API/Token
    public function setUser(\Illuminate\Contracts\Auth\Authenticatable $user)
    {
        $this->user = $user;
    }
}
</code></pre>


    {{-- SEZIONE 3: Collegamento del Guard (Lezione 100) --}}
    <h3 class="text-2xl font-semibold text-gray-700 pt-6 border-l-4 border-indigo-500 pl-3">
        3. Collegamento: Registrare il Custom Guard
    </h3>
    <p class="text-gray-700">
        Dobbiamo dire a Laravel di associare il driver **'static'** (definito in <code>config/auth.php</code>) alla nostra classe **`StaticTokenGuard`**. Lo facciamo nel Service Provider.
    </p>

    <h4 class="text-xl font-medium text-gray-600 mt-6 mb-3">Modifica <code>app/Providers/AuthServiceProvider.php</code>:</h4>
    <pre class="bg-gray-900 text-green-400 p-4 rounded-lg overflow-x-auto shadow-inner text-sm"><code>
// ... all'inizio del file
use App\Guards\StaticTokenGuard; // Importa il nostro Custom Guard

class AuthServiceProvider extends ServiceProvider
{
    // ...
    protected $policies = [
        Note::class => NotePolicy::class,
    ];

    /**
     * Registra i servizi di autenticazione dell'applicazione.
     */
    public function boot(): void
    {
        // Chiamiamo il metodo extend del Manager per aggiungere il nostro driver custom
        Auth::extend('static', function ($app, $name, array $config) {
            // Ritorna una nuova istanza del nostro Custom Guard
            return new StaticTokenGuard(
                Auth::createUserProvider($config['provider']), // Passa il Provider (users)
                $app['request'] // Passa l'oggetto Request
            );
        });
    }
}
</code></pre>


    {{-- SEZIONE 4: Test del Custom Guard --}}
    <h3 class="text-2xl font-semibold text-gray-700 pt-6 border-l-4 border-indigo-500 pl-3">
        4. Test: Usare il Nuovo Guard
    </h3>
    <p class="text-gray-700">
        Possiamo ora proteggere una rotta usando il nostro Guard custom `token_static`. Solo chi passa l'header corretto avrà accesso.
    </p>

    <h4 class="text-xl font-medium text-gray-600 mt-6 mb-3">Aggiungi a <code>routes/web.php</code>:</h4>
    <pre class="bg-gray-900 text-green-400 p-4 rounded-lg overflow-x-auto shadow-inner text-sm"><code>
// ...
// Rotta protetta dal Custom Guard (Lezione 100)
Route::get('/custom-auth-test', function () {
    return 'Accesso con Custom Guard riuscito! Utente: ' . Auth::user()->name;
})->middleware('auth:token_static'); // Specifichiamo il Guard da usare
</code></pre>

    <p class="text-lg text-red-600 font-bold mt-6">
        Testare questo Guard: Devi usare un client HTTP (come Postman o Insomnia) e inviare una richiesta GET a <code>/custom-auth-test</code> aggiungendo l'header:
        <span class="block bg-yellow-100 p-2 my-2 rounded-md font-mono text-base">
            X-Static-Token: MY_SECRET_STATIC_TOKEN_123
        </span>
    </p>
    <p class="text-gray-700">Se l'header è corretto, il Guard ti autenticherà come Utente 1 e vedrai il messaggio di successo!</p>


</div>
