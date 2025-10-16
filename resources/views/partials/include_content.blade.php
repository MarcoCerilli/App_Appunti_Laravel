{{-- HEADLINE: Sostituisce h1.h2.mb-4 --}}
<h1 class="text-2xl font-bold mb-4 text-gray-800">Lezione sulla Direttiva @@include</h1>

{{-- PARAGRAFO: Sostituisce p.mb-4 --}}
<p class="mb-6 text-gray-600">
    Mentre <code>@@extends</code> gestisce la struttura della pagina, <code>@@include</code> serve per riutilizzare
    piccole porzioni di codice (come bottoni, form o alert) all'interno di una singola vista o sezione.
    Questo riduce la duplicazione e migliora la manutenibilità.
</p>

{{-- I partials inclusi (assumendo che le card al loro interno siano state convertite) --}}
@include('partials.include_card1')
@include('partials.include_card2')
@include('partials.include_card3')
