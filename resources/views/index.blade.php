<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    {{-- Assicurati che app.css abbia classi per .sidebar e .main-content --}}
    @vite('resources/css/app.css')
</head>

<body class="flex min-h-screen"> {{-- Aggiungo 'flex min-h-screen' per layout side-by-side --}}

    {{-- SIDEBAR --}}
    <div class="sidebar bg-gray-800 text-white p-4 w-64 flex-shrink-0">
        <h4 class="text-xl font-semibold mb-4 border-b border-gray-700 pb-2">Menu Didattico</h4>

        {{-- Navigation Links --}}
        <nav class="space-y-1 flex flex-col">
            <a href="{{ route('ereditarieta') }}" class="py-2 px-3 rounded-lg hover:bg-gray-700 transition duration-150 {{ request()->routeIs('ereditarieta') ? 'bg-gray-700 font-bold' : '' }}">
                Ereditarietà
            </a>
            <a href="{{ route('condizionali') }}" class="py-2 px-3 rounded-lg hover:bg-gray-700 transition duration-150 {{ request()->routeIs('condizionali') ? 'bg-gray-700 font-bold' : '' }}">
                Condizionali
            </a>
            <a href="{{ route('include') }}" class="py-2 px-3 rounded-lg hover:bg-gray-700 transition duration-150 {{ request()->routeIs('include') ? 'bg-gray-700 font-bold' : '' }}">
                Include
            </a>
            <a href="{{ route('query.builder') }}" class="py-2 px-3 rounded-lg hover:bg-gray-700 transition duration-150 {{ request()->routeIs('query.builder') ? 'bg-gray-700 font-bold' : '' }}">
                Query Builder
            </a>
            <a href="{{ route('seeders') }}" class="py-2 px-3 rounded-lg hover:bg-gray-700 transition duration-150 {{ request()->routeIs('seeders') ? 'bg-gray-700 font-bold' : '' }}">
                Seeders
            </a>
            <a href="{{ route('service.providers') }}" class="py-2 px-3 rounded-lg hover:bg-gray-700 transition duration-150 {{ request()->routeIs('service.providers') ? 'bg-gray-700 font-bold' : '' }}">
                Service Providers
            </a>
            <a href="{{ route('notes.index') }}" class="py-2 px-3 rounded-lg hover:bg-gray-700 transition duration-150 {{ request()->routeIs('notes.*') ? 'bg-gray-700 font-bold' : '' }}">
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
        </nav>

        {{-- Posiziono il logout anche in sidebar come opzione secondaria, a fondo pagina --}}
        <div class="mt-auto pt-4 border-t border-gray-700">
             @auth
                <form action="{{ route('logout') }}" method="POST" class="w-full">
                    @csrf
                    <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded transition duration-150">
                        Logout ({{ Auth::user()->name }})
                    </button>
                </form>
            @else
                <p class="text-sm text-gray-400">Accedi per funzionalità aggiuntive.</p>
            @endauth
        </div>

    </div>

    {{-- MAIN CONTENT --}}
    <div class="main-content p-6 flex-grow overflow-y-auto"> {{-- Aggiunto flex-grow per riempire lo spazio --}}
        <div class="w-full max-w-4xl mx-auto">

            <!-- *** POSIZIONE PRINCIPALE DEL BANNER DI STATO LOGIN/LOGOUT *** -->
            @auth
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 shadow-md flex justify-between items-center rounded-lg" role="alert">
                    <p class="font-bold">✅ Sei loggato come: {{ Auth::user()->email }}</p>
                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-1 px-3 rounded transition duration-150 text-sm shadow">
                            Logout
                        </button>
                    </form>
                </div>
            @else
                <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-6 shadow-md flex justify-between items-center rounded-lg" role="alert">
                    <p class="font-bold">⚠️ Non sei loggato.</p>
                    <a href="{{ route('manual.login') }}" class="text-yellow-700 hover:text-yellow-800 font-semibold underline transition duration-150">
                        Accedi qui
                    </a>
                </div>
            @endauth
            <!-- ************************************************************* -->

            @yield('content')

        </div>
    </div>
</body>

</html>
