@php
// Definiamo un messaggio e un tipo di default se non vengono passati
$message = $message ?? 'Messaggio di default dal componente parziale.';
$type = $type ?? 'info';
@endphp

{{-- ALERT Bootstrap (il tipo viene iniettato dalla variabile $type) --}}

<div class="alert alert-{{ $type }} mt-3 mb-0" role="alert">
<strong>Componente:</strong> {{ $message }}
</div>
