{{-- CARD: Sostituisce .card.mb-4.shadow-sm --}}
<div class="bg-white mb-6 shadow-lg rounded-lg overflow-hidden">
    {{-- CARD HEADER (PRIMARY/BLU): Sostituisce .card-header.bg-primary.text-white --}}
    <div class="p-4 text-white font-semibold" style="background-color: #6c5ce7;">
        1. @@include Semplice
    </div>

    {{-- CARD BODY: Sostituisce .card-body --}}
    <div class="p-6">
        <h5 class="text-xl font-bold mb-3 text-gray-800">Sintassi Base</h5>
        <p class="mb-4">Sintassi: <code>@@include('nome.del.file')</code>. Il file parziale eredita tutte le variabili
            dalla vista madre.</p>

        {{-- BOX EVIDENZIATO: Sostituisce .border.p-3.bg-light.rounded-2 --}}
        <div class="border border-gray-300 p-4 bg-gray-50 rounded-lg">
            <strong class="block mb-2 text-gray-700">Esempio di codice:</strong> <code>@@include('components.alert_message')</code>
            <hr class="my-4 border-gray-300">
            <p class="font-semibold mb-2">Output:</p>

            {{-- INCLUDE SEMPLICE --}}
            {{-- Devi assicurarti che 'components.alert_message' sia convertito a Tailwind --}}
            @include('components.alert_message')
        </div>
    </div>
</div>
