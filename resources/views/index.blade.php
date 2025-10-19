<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        // Configurazione Tailwind per Font Inter (opzionale, ma mantiene lo stile)
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <style>
        /* CSS per il comportamento mobile */

        /* Overlay semi-trasparente per mobile */
        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.6);
            z-index: 40;
            display: none;
        }

        .sidebar-overlay.is-open {
            display: block;
        }

        /* La classe is-open è usata dal JS su mobile per forzare la sidebar in vista */
        .sidebar.is-open {
            transform: translateX(0) !important;
        }

        /* Navigazione interna alla sidebar */
        .sidebar nav {
            overflow-y: auto;
        }

        /* Nascondi il pulsante hamburger su schermi grandi */
        @media (min-width: 1024px) {
            #open-sidebar-btn {
                display: none;
            }
        }
    </style>
    {{-- LASCIO @vite('resources/css/app.css') se usi un toolchain Laravel --}}
</head>

{{-- CORREZIONE: Rimuovo 'overflow-hidden' dal body per permettere lo scroll della pagina principale --}}
<body class="font-sans bg-gray-50">

    {{-- Overlay per mobile: Cliccando chiude la sidebar. Visibile solo su schermi piccoli --}}
    <div id="sidebar-overlay" class="sidebar-overlay lg:hidden" onclick="toggleSidebar()"></div>


    {{-- 1. SIDEBAR --}}
    {{-- FIXED su tutti i dispositivi. Su mobile è nascosta (-translate-x-full). Su desktop è visibile (lg:translate-x-0) e fissa in posizione. --}}
    <div id="sidebar"
        class="sidebar bg-gray-800 text-white p-4 w-64 flex flex-col flex-shrink-0 h-screen
               fixed top-0 left-0 z-50 transition-transform duration-300 transform -translate-x-full lg:translate-x-0 lg:shadow-xl">

        {{-- Bottone di chiusura per Mobile (Icona X) --}}
        <button id="close-sidebar-btn" class="lg:hidden absolute top-4 right-4 text-white hover:text-gray-300 z-50" onclick="toggleSidebar()">
            <!-- Icona X (Close) -->
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>

        <h4 class="text-xl font-semibold mb-4 border-b border-gray-700 pb-2">Menu Didattico</h4>

        {{-- Navigation Links (Contenitore Scrollabile) --}}
        <nav class="space-y-1 flex flex-col flex-grow overflow-y-auto pr-2">

            {{-- ********** LINK CON SINTASSI BLADE PRESERVATA ********** --}}
            <a href="{{ route('ereditarieta') }}"
                class="py-2 px-3 rounded-lg hover:bg-gray-700 transition duration-150 {{ request()->routeIs('ereditarieta') ? 'bg-gray-700 font-bold' : '' }}">
                Ereditarietà
            </a>
            <a href="{{ route('condizionali') }}"
                class="py-2 px-3 rounded-lg hover:bg-gray-700 transition duration-150 {{ request()->routeIs('condizionali') ? 'bg-gray-700 font-bold' : '' }}">
                Condizionali
            </a>
            <a href="{{ route('include') }}"
                class="py-2 px-3 rounded-lg hover:bg-gray-700 transition duration-150 {{ request()->routeIs('include') ? 'bg-gray-700 font-bold' : '' }}">
                Include
            </a>
            <a href="{{ route('query.builder') }}"
                class="py-2 px-3 rounded-lg hover:bg-gray-700 transition duration-150 {{ request()->routeIs('query.builder') ? 'bg-gray-700 font-bold' : '' }}">
                Query Builder
            </a>
            <a href="{{ route('seeders') }}"
                class="py-2 px-3 rounded-lg hover:bg-gray-700 transition duration-150 {{ request()->routeIs('seeders') ? 'bg-gray-700 font-bold' : '' }}">
                Seeders
            </a>
            <a href="{{ route('service.providers') }}"
                class="py-2 px-3 rounded-lg hover:bg-gray-700 transition duration-150 {{ request()->routeIs('service.providers') ? 'bg-gray-700 font-bold' : '' }}">
                Service Providers
            </a>
            <a href="{{ route('notes.index') }}"
                class="py-2 px-3 rounded-lg hover:bg-gray-700 transition duration-150 {{ request()->routeIs('notes.*') ? 'bg-gray-700 font-bold' : '' }}">
                Gestione Appunti
            </a>
            <a href="{{ route('guards.providers') }}"
                class="py-2 px-3 rounded-lg hover:bg-gray-700 transition duration-150 {{ request()->routeIs('guards.providers') ? 'bg-gray-700 font-bold' : '' }}">
                Guards-Providers
            </a>
            <a href="{{ route('manual.login') }}"
                class="py-2 px-3 rounded-lg hover:bg-gray-700 transition duration-150 {{ request()->routeIs('manual.login') ? 'bg-gray-700 font-bold' : '' }}">
                Login Manuale
            </a>
            <a href="{{ route('auth.flexible') }}"
                class="py-2 px-3 rounded-lg hover:bg-gray-700 transition duration-150 {{ request()->routeIs('auth.flexible') ? 'bg-gray-700 font-bold' : '' }}">
                Auth: Middleware vs Controller
            </a>
            <a href="{{ route('storage.cache.session.intro') }}"
                class="py-2 px-3 rounded-lg hover:bg-gray-700 transition duration-150 {{ request()->routeIs('storage.cache.session.intro') ? 'bg-gray-700 font-bold' : '' }}">
                Storage, Sessioni & Cache (Intro)
            </a>
            {{-- *************************************************************** --}}

            {{-- Aggiungo 10 link extra di test per garantire lo scroll interno alla sidebar --}}
            @for ($i = 1; $i <= 10; $i++)
                <a href="#" class="py-2 px-3 rounded-lg hover:bg-gray-700 transition duration-150 text-sm text-gray-400">
                    Test Scroll Link {{ $i }}
                </a>
            @endfor
        </nav>

        {{-- Logout/Info Accesso (Sempre in fondo) --}}
        <div class="pt-4 mt-auto border-t border-gray-700">
            @auth
                <form action="{{ route('logout') }}" method="POST" class="w-full">
                    @csrf
                    <button type="submit"
                        class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded transition duration-150 shadow-lg">
                        Logout ({{ Auth::user()->name }})
                    </button>
                </form>
            @else
                <p class="text-sm text-gray-400">Accedi per funzionalità aggiuntive.</p>
            @endauth
        </div>

    </div>

    {{-- 2. MAIN CONTENT --}}
    {{-- Aggiungo il padding superiore su mobile (pt-16) per evitare che il contenuto sia coperto dal pulsante hamburger fisso. --}}
    {{-- Aggiungo ml-64 (margin-left) solo su schermi grandi (lg) per compensare la sidebar fissa. --}}
    <div class="main-content p-6 flex-grow bg-gray-50 min-h-screen lg:ml-64 pt-16 lg:pt-6">

        <!-- Menu Hamburger per Mobile (Visibile solo su schermi piccoli) -->
        <button id="open-sidebar-btn" class="fixed top-4 left-4 p-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg shadow-xl transition duration-150 z-30" onclick="toggleSidebar()">
            <!-- Icona Hamburger -->
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
        </button>

        <div class="w-full max-w-4xl mx-auto">

            <!-- *** POSIZIONE PRINCIPALE DEL BANNER DI STATO LOGIN/LOGOUT *** -->
            @auth
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 shadow-md flex justify-between items-center rounded-lg"
                    role="alert">
                    <p class="font-bold">✅ Sei loggato come: {{ Auth::user()->email }}</p>
                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit"
                            class="bg-green-600 hover:bg-green-700 text-white font-semibold py-1 px-3 rounded transition duration-150 text-sm shadow">
                            Logout
                        </button>
                    </form>
                </div>
            @else
                <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-6 shadow-md flex justify-between items-center rounded-lg"
                    role="alert">
                    <p class="font-bold">⚠️ Non sei loggato.</p>
                    <a href="{{ route('manual.login') }}"
                        class="text-yellow-700 hover:text-yellow-800 font-semibold underline transition duration-150">
                        Accedi qui
                    </a>
                </div>
            @endauth
            <!-- ************************************************************* -->

            <main>
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        // Funzione per gestire l'apertura e chiusura della sidebar su mobile
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');

            // Toggle della classe 'is-open' che forza la visibilità su mobile
            const isOpen = sidebar.classList.toggle('is-open');

            if (isOpen) {
                overlay.classList.add('is-open');
                // Impedisce lo scroll del body quando la sidebar è aperta
                document.body.style.overflow = 'hidden';
            } else {
                overlay.classList.remove('is-open');
                // Ripristina lo scroll del body
                document.body.style.overflow = '';
            }
        }

        // Gestisce il caso in cui l'utente ridimensiona da mobile a desktop
        window.addEventListener('resize', () => {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');

            // 1024px è il breakpoint 'lg' di Tailwind
            if (window.innerWidth >= 1024) {
                // Su desktop, assicuriamo che lo scroll del body sia attivo e le classi mobile siano rimosse
                sidebar.classList.remove('is-open');
                overlay.classList.remove('is-open');
                document.body.style.overflow = '';
            }
        });
    </script>

</body>

</html>
