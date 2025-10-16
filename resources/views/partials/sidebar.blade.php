<nav class="sidebar">
    {{-- TITOLO: Usa la classe .sidebar h4 definita nel tuo app.css --}}
    <h4 class="sidebar-title">Laravel Appunti</h4>

    {{-- LISTA DI NAVIGAZIONE: Rimosse .nav e .flex-column, affidandosi a .sidebar a per il layout verticale --}}
    <ul class="space-y-1">

        {{-- Ogni <li> è stato rimosso in favore di un <a> diretto per semplificare la struttura --}}

        <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">
            <i class="bi bi-house-door"></i> Home
        </a>

        <a href="{{ route('condizionali') }}" class="{{ request()->routeIs('condizionali') ? 'active' : '' }}">
            <i class="bi bi-code-slash"></i> Condizionali
        </a>

        <a href="{{ route('include') }}" class="{{ request()->routeIs('include') ? 'active' : '' }}">
            <i class="bi bi-folder-plus"></i> Include
        </a>

        <a href="{{ route('ereditarieta') }}" class="{{ request()->routeIs('ereditarieta') ? 'active' : '' }}">
            <i class="bi bi-diagram-3"></i> Ereditarietà
        </a>

        <a href="{{ route('seeders') }}" class="{{ request()->routeIs('seeders') ? 'active' : '' }}">
            <i class="bi bi-database"></i> Seeders
        </a>

        <a href="{{ route('query.builder') }}" class="{{ request()->routeIs('query.builder') ? 'active' : '' }}">
            <i class="bi bi-gear"></i> Query Builder
        </a>

    </ul>
</nav>
