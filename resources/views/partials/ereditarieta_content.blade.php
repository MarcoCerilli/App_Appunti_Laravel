{{-- CARD: Sostituisce .card.mb-4.shadow-sm --}}
<div class="bg-white mb-6 shadow-lg rounded-xl overflow-hidden">
    {{-- CARD HEADER (BLU): Sostituisce .card-header.bg-primary.text-white --}}
    <div class="p-4 text-white font-semibold" style="background-color: #6c5ce7;">
        1. Direttiva @@extends
    </div>

    {{-- CARD BODY: Sostituisce .card-body --}}
    <div class="p-6">
        {{-- CARD TITLE: Sostituisce .card-title --}}
        <h5 class="text-xl font-bold mb-3 text-gray-800">Ereditarietà delle Viste</h5>
        <p class="mb-3">
            Blade permette di definire un layout principale (ad esempio <code>index.blade.php</code>)
            e farlo estendere da tutte le altre viste tramite <code>@@extends('index')</code>.
        </p>
        <p class="mb-4">
            Questo approccio evita la duplicazione di codice e mantiene coerente la struttura del sito.
        </p>

        {{-- BLOCCO CODICE: Sostituisce pre --}}
        <pre class="bg-gray-800 p-4 rounded-lg text-green-400 overflow-x-auto text-sm"><code>@@extends('index')

@@section('title', 'Titolo Pagina')

@@section('content')
&lt;h1&gt;Contenuto della pagina&lt;/h1&gt;
@@endsection
</code></pre>
    </div>
</div>



{{-- CARD: Sostituisce .card.mb-4.shadow-sm --}}
<div class="bg-white mb-6 shadow-lg rounded-xl overflow-hidden">
    {{-- CARD HEADER (VERDE): Sostituisce .card-header.bg-success.text-white --}}
    <div class="p-4 text-white font-semibold" style="background-color: #00b894;">
        2. Direttiva @@section e @@yield
    </div>

    {{-- CARD BODY: Sostituisce .card-body --}}
    <div class="p-6">
        <p class="mb-4">
            <code>@@section</code> definisce il contenuto che verrà inserito negli spazi indicati da <code>@@yield</code>
            nel layout principale.
        </p>

        {{-- BOX EVIDENZIATO: Sostituisce .border.p-3.bg-light.rounded-2 --}}
        <div class="border border-gray-300 p-4 bg-gray-50 rounded-lg">
            <strong class="block mb-2 text-gray-700">Esempio nel layout:</strong>
            <pre class="bg-gray-800 p-3 rounded-lg text-green-400 overflow-x-auto text-sm mb-4"><code>&lt;title&gt;@@yield('title')&lt;/title&gt;
&lt;body&gt;
@@yield('content')
&lt;/body&gt;</code></pre>

            <strong class="block mb-2 text-gray-700">Esempio nella vista figlia:</strong>
            <pre class="bg-gray-800 p-3 rounded-lg text-green-400 overflow-x-auto text-sm"><code>@@section('title', 'Home Page')

@@section('content')
&lt;p&gt;Questo testo verrà inserito al posto di @@yield('content').&lt;/p&gt;
@@endsection</code></pre>
        </div>
    </div>
</div>



{{-- CARD: Sostituisce .card.mb-4.shadow-sm --}}
<div class="bg-white mb-6 shadow-lg rounded-xl overflow-hidden">
    {{-- CARD HEADER (AZZURRO): Sostituisce .card-header.bg-info.text-white --}}
    <div class="p-4 text-white font-semibold" style="background-color: #00b894;">
        3. Direttiva @@include
    </div>

    {{-- CARD BODY: Sostituisce .card-body --}}
    <div class="p-6">
        <p class="mb-4">
            L’ereditarietà si combina con <code>@@include</code>, che serve per includere piccole parti
            riutilizzabili (come sidebar, footer o componenti).
        </p>

        {{-- BLOCCO CODICE: Sostituisce pre --}}
        <pre class="bg-gray-800 p-4 rounded-lg text-green-400 overflow-x-auto text-sm mb-4"><code>@@include('partials.sidebar')</code></pre>

        <p>
            Questo rende le viste più modulari e facilmente manutenibili.
        </p>
    </div>
</div>
