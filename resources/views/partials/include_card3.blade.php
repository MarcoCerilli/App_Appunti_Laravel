{{-- CARD: Sostituisce .card.mb-4.shadow-sm --}}
<div class="bg-white mb-6 shadow-lg rounded-lg overflow-hidden">
    {{-- CARD HEADER (INFO/AZZURRO): Sostituisce .card-header.bg-info.text-white --}}
    <div class="p-4 text-white font-semibold" style="background-color: #00b894;">
        3. Direttiva @@includeUnless
    </div>

    {{-- CARD BODY: Sostituisce .card-body --}}
    <div class="p-6">
        <h5 class="text-xl font-bold mb-3 text-gray-800">Inclusione Condizionale</h5>
        <p class="mb-4">La direttiva <code>@@includeUnless($condition, 'view.name')</code> include la vista **solo se** la condizione è **falsa**.</p>

        <p class="mb-4 text-sm font-mono bg-gray-100 p-2 rounded">
            <strong>Variabile di test:</strong> <code>$user_role</code> = <code>{{ $user_role }}</code>
        </p>

        {{-- BOX EVIDENZIATO: Sostituisce .border.p-3.bg-light.rounded-2 --}}
        <div class="border border-gray-300 p-4 bg-gray-50 rounded-lg">
            <strong class="block mb-2 text-gray-700">Esempio:</strong> Se <code>$user_role</code> è 'admin', questo blocco verrà saltato.
            <hr class="my-4 border-gray-300">

            @includeUnless($user_role === 'admin', 'components.alert_message', ['type' => 'danger', 'message' => 'Non sei admin, questo messaggio viene mostrato.'])

            @if ($user_role === 'admin')
                {{-- ALERT SUCCESS: Sostituisce .alert.alert-success.mt-3 --}}
                <div class="p-4 mt-3 bg-emerald-100 text-emerald-800 border-l-4 border-emerald-500 rounded" role="alert">
                    L'utente è Admin, quindi il blocco @@includeUnless è stato saltato.
                </div>
            @endif
        </div>
    </div>
</div>
