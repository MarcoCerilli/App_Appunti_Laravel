<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Providers e Architettura di Laravel - Lezione</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Imposta la font Inter */
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f9fafb;
            /* Rimuove min-h-screen e flex dal body per consentire lo scorrimento naturale */
            /* Il contenuto scrolla normalmente, la sidebar è fissa con 'fixed' */
        }

        /* Sidebar: Fissa, copre l'intera altezza (100vh) e non scrolla con la pagina */
        .sidebar {
            height: 100vh;
            position: fixed; /* Rende la sidebar fissa nel viewport */
            top: 0;
            left: 0;
            z-index: 20; /* Assicura che sia sopra al contenuto */
        }

        /* Sidebar Nav: Permette lo scorrimento dei link all'interno della sidebar */
        .sidebar nav {
            /* Permette lo scorrimento dei link se sono troppi */
            overflow-y: auto;
        }

        /* Stile personalizzato per la scrollbar della sidebar (opzionale, per estetica) */
        .sidebar nav::-webkit-scrollbar {
            width: 8px;
        }

        .sidebar nav::-webkit-scrollbar-thumb {
            background-color: #4b5563;
            border-radius: 4px;
        }

        .sidebar nav::-webkit-scrollbar-track {
            background: #374151;
        }
    </style>
</head>

{{-- CORREZIONE: Il body è standard per permettere lo scorrimento della pagina --}}
<body>

    {{-- 1. SIDEBAR (Fissa) --}}
    <div class="sidebar bg-gray-800 text-white p-4 w-64 flex flex-col flex-shrink-0">
        <h4 class="text-xl font-semibold mb-4 border-b border-gray-700 pb-2">Menu Didattico</h4>

        {{-- Navigation Links (Contenitore Scrollabile all'interno della sidebar) --}}
        <nav class="space-y-1 flex flex-col flex-grow pr-2">

            <!-- Link di navigazione statici -->
            <a href="#" class="py-2 px-3 rounded-lg hover:bg-gray-700 transition duration-150">
                Ereditarietà
            </a>
            <a href="#" class="py-2 px-3 rounded-lg hover:bg-gray-700 transition duration-150">
                Condizionali
            </a>
            <a href="#" class="py-2 px-3 rounded-lg hover:bg-gray-700 transition duration-150">
                Include
            </a>
            <a href="#" class="py-2 px-3 rounded-lg hover:bg-gray-700 transition duration-150">
                Query Builder
            </a>
            <a href="#" class="py-2 px-3 rounded-lg hover:bg-gray-700 transition duration-150">
                Seeders
            </a>
            <a href="#" class="py-2 px-3 rounded-lg bg-gray-700 font-bold transition duration-150">
                Service Providers
            </a>
            <a href="#" class="py-2 px-3 rounded-lg hover:bg-gray-700 transition duration-150">
                Gestione Appunti
            </a>
            <a href="#" class="py-2 px-3 rounded-lg hover:bg-gray-700 transition duration-150">
                Guards-Providers
            </a>
            <a href="#" class="py-2 px-3 rounded-lg hover:bg-gray-700 transition duration-150">
                Login Manuale
            </a>
            <a href="#" class="py-2 px-3 rounded-lg hover:bg-gray-700 transition duration-150">
                Auth: Middleware vs Controller
            </a>
            <a href="#" class="py-2 px-3 rounded-lg hover:bg-gray-700 transition duration-150">
                Storage, Sessioni & Cache (Intro)
            </a>
            <!-- Aggiungo alcuni link extra per testare lo scroll della sidebar stessa -->
            <a href="#" class="py-2 px-3 rounded-lg hover:bg-gray-700 transition duration-150">
                Test Scroll Link 1
            </a>
            <a href="#" class="py-2 px-3 rounded-lg hover:bg-gray-700 transition duration-150">
                Test Scroll Link 2
            </a>
            <a href="#" class="py-2 px-3 rounded-lg hover:bg-gray-700 transition duration-150">
                Test Scroll Link 3
            </a>
            <a href="#" class="py-2 px-3 rounded-lg hover:bg-gray-700 transition duration-150">
                Test Scroll Link 4
            </a>
            <a href="#" class="py-2 px-3 rounded-lg hover:bg-gray-700 transition duration-150">
                Test Scroll Link 5
            </a>
        </nav>

        {{-- Logout/Info Accesso (Sempre in fondo) --}}
        <div class="pt-4 mt-auto border-t border-gray-700">
            <!-- Simulo lo stato loggato -->
            <div class="w-full">
                <button type="submit"
                    class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded transition duration-150">
                    Logout (Utente Esempio)
                </button>
            </div>
        </div>

    </div>

    {{-- 2. MAIN CONTENT (Scrollabile) --}}
    {{-- Aggiungo ml-64 per spostare il contenuto a destra della sidebar fissa. --}}
    <div class="main-content p-6 ml-64 bg-gray-50 w-full">
        <div class="w-full max-w-4xl mx-auto">

            <!-- *** BANNER DI STATO LOGIN/LOGOUT (Statico) *** -->
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 shadow-md flex justify-between items-center rounded-lg"
                role="alert">
                <p class="font-bold">✅ Sei loggato come: utente.esempio@lezioni.it</p>
                <button
                    class="bg-green-600 hover:bg-green-700 text-white font-semibold py-1 px-3 rounded transition duration-150 text-sm shadow">
                    Logout
                </button>
            </div>
            <!-- ************************************************************* -->

            <!-- CONTENUTO LEZIONE: Service Providers e Architettura di Laravel (Base Teorica) -->
            <div class="lesson-content space-y-8">

                {{-- INTRODUZIONE --}}
                <div class="text-left mb-8">
                    <h2 class="text-4xl font-extrabold text-indigo-700 mb-4">Service Providers e il Cuore di Laravel
                    </h2>
                    <p class="text-lg text-gray-600 max-w-4xl">
                        I **Service Providers** non sono solo file di configurazione; sono la spina dorsale dell'architettura
                        di Laravel, i punti centrali da cui l'intera applicazione viene avviata e gestita. Capire il loro
                        ruolo è fondamentale per qualsiasi debug avanzato.
                    </p>
                    <hr class="my-6 border-indigo-200">
                </div>

                {{-- SEZIONE 1: Cos'è un Service Provider --}}
                <h3 class="text-2xl font-semibold text-gray-700 border-l-4 border-indigo-500 pl-3">
                    1. Il Ruolo del Service Provider
                </h3>
                <p class="text-gray-700">
                    I Service Providers sono i **"configuratori"** dell'applicazione. Quasi tutte le funzionalità di Laravel
                    (Routing, Database, Validazione, il sistema di Autenticazione) vengono inizializzate e messe a
                    disposizione (registrate) tramite un Provider.
                </p>
                <p class="text-gray-700 mt-2">
                    **L'obiettivo:** Insegnare al framework come costruire e caricare i suoi servizi.
                </p>

                {{-- SEZIONE 2: Il Service Container --}}
                <h3 class="text-2xl font-semibold text-gray-700 pt-6 border-l-4 border-indigo-500 pl-3">
                    2. Il Concetto Fondamentale: Il Service Container (IoC)
                </h3>
                <p class="text-gray-700">
                    I Providers lavorano a stretto contatto con il **Service Container** (o IoC - *Inversion of Control*
                    Container). Questo è una "super-scatola" che gestisce la creazione di tutte le classi e le loro
                    dipendenze.
                </p>

                <ul class="list-disc list-inside space-y-2 ml-4 text-gray-700">
                    <li>
                        <strong class="text-indigo-600">Registrazione:</strong> Il Provider *registra* un servizio, dicendo
                        al Container: "Quando qualcuno ha bisogno della classe X, ecco come devi fornirla."
                    </li>
                    <li>
                        <strong class="text-indigo-600">Risoluzione (Dependency Injection):</strong> Il Container *risolve*
                        automaticamente la dipendenza (creando l'oggetto richiesto) e la *inietta* dove serve (ad esempio,
                        nel costruttore di un controller).
                    </li>
                </ul>

                {{-- SEZIONE 3: I Metodi Chiave --}}
                <h3 class="text-2xl font-semibold text-gray-700 pt-6 border-l-4 border-indigo-500 pl-3">
                    3. I Metodi <code>register()</code> e <code>boot()</code>
                </h3>
                <p class="text-gray-700">
                    Ogni Service Provider personalizzato (come <code>AuthServiceProvider</code>) ha due metodi eseguiti in
                    momenti diversi del ciclo di vita di Laravel:
                </p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                    {{-- register() --}}
                    <div class="bg-indigo-50 p-4 rounded-lg shadow">
                        <h4 class="text-xl font-bold text-indigo-700 mb-2">Il Metodo <code>register()</code></h4>
                        <p class="text-sm text-gray-800">
                            Usato per **legare (bind)** servizi al Container. Qui si definisce "cosa esiste". Non si devono
                            usare servizi, ma solo registrarli.
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
                        <h4 class="text-xl font-bold text-green-700 mb-2">Il Metodo <code>boot()</code></h4>
                        <p class="text-sm text-gray-800">
                            Eseguito **DOPO** che tutti i <code>register()</code> sono stati completati. Qui si usa
                            l'applicazione per configurare le cose.
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
                    Nel nostro caso, la Gate era definita nel metodo <code>boot()</code> di <code>AuthServiceProvider</code>.
                    L'errore è avvenuto perché il provider **non era elencato** nell'array <code>'providers'</code> del file
                    <code>config/app.php</code>.
                </p>

                <p class="text-gray-700 mt-2 p-3 bg-red-50 border-l-4 border-red-400">
                    Se un Provider non è registrato in <code>config/app.php</code>, Laravel lo ignora completamente. Di
                    conseguenza, il suo metodo <code>boot()</code> (che conteneva la nostra logica <code>Gate::define</code>)
                    **non è mai stato chiamato**, e l'autorizzazione è rimasta inattiva.
                </p>

                {{-- Contenuto extra per testare lo scroll --}}
                <h3 class="text-xl font-semibold text-gray-700 pt-6">
                    Aggiunta per Testare lo Scroll (Pagina Intera)
                </h3>
                <div class="space-y-4 pt-2 text-gray-600">
                    <p>Questo è del testo extra per garantire che l'area del contenuto principale diventi abbastanza lunga da attivare lo scrolling sull'intera pagina.</p>
                    <p>Ora l'intera pagina (il tag `body`) è scrollabile, mentre la sidebar rimane sempre visibile grazie alla proprietà CSS `position: fixed;`.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
                    <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>
                    <p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>
                    <p class="h-96 bg-indigo-100 flex items-center justify-center rounded-lg shadow-inner">Area di Riempimento 1</p>
                    <p>Ancora più spazio per lo scroll.</p>
                    <p class="h-96 bg-indigo-100 flex items-center justify-center rounded-lg shadow-inner">Area di Riempimento 2</p>
                    <p>Questo è l'ultimo paragrafo di test per assicurarci che lo scroll funzioni perfettamente e la sidebar rimanga fissa.</p>
                </div>

            </div>

        </div>
    </div>
</body>

</html>
