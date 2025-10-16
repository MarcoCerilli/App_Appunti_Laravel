{{-- CARD: Sostituisce .card.mb-4.shadow-sm --}}
<div class="bg-white mb-6 shadow-lg rounded-lg overflow-hidden">
    {{-- CARD HEADER (SUCCESS/VERDE): Sostituisce .card-header.bg-success.text-white --}}
    <div class="p-4 text-white font-semibold" style="background-color: #00b894;">
        2. @@include con Dati
    </div>

    {{-- CARD BODY: Sostituisce .card-body --}}
    <div class="p-6">
        <h5 class="text-xl font-bold mb-3 text-gray-800">Passare Dati al Parziale</h5>
        <p class="mb-4">È possibile passare dati extra in un array associativo, che avranno precedenza sulle variabili della vista madre.
            Sintassi: <code>@@include('nome.del.file', ['variabile' => 'valore'])</code>.</p>

        {{-- BOX EVIDENZIATO: Sostituisce .border.p-3.bg-light.rounded-2 --}}
        <div class="border border-gray-300 p-4 bg-gray-50 rounded-lg">
            <strong class="block mb-2 text-gray-700">Esempio di codice:</strong> <code>@@include('components.alert_message', ['type' => 'warning', 'message' => 'Attenzione, dati non aggiornati.'])</code>
            <hr class="my-4 border-gray-300">
            <p class="font-semibold mb-2">Output:</p>

            {{-- INCLUDE CON DATI --}}
            @include('components.alert_message', ['type' => 'warning', 'message' => 'Attenzione, dati non aggiornati.'])
        </div>
    </div>
</div>
