@extends('index') {{-- ESTENDE IL TUO LAYOUT PRINCIPALE --}}

@section('title', 'Gestione Appunti')

@section('content')
    {{-- CONTENITORE: Sostituisce .container-fluid e .p-0 --}}
    <div class="w-full">

        {{-- HEADER E BOTTONE CREA: Sostituisce .d-flex e .justify-content-between --}}
        <div class="flex justify-between items-center mb-4 border-b pb-3">
            <h1 class="text-2xl" style="color: #2c3e50; font-weight: bold;">I Miei Appunti</h1>

            {{-- BOTTONE NUOVA NOTA: Sostituisce .btn.btn-primary.shadow-sm --}}
            <a href="{{ route('notes.create') }}" class="text-white font-semibold py-2 px-4 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300" style="background-color: #6c5ce7; border: none;">
                <i class="fas fa-plus"></i> Nuova Nota
            </a>
        </div>

        {{-- ALERT DI SUCCESSO --}}
        @if (session('success'))
            {{-- Usa il tuo componente alert_message.blade.php, che deve essere stilizzato con il tuo CSS/Tailwind --}}
            @include('components.alert_message', ['message' => session('success'), 'type' => 'success'])
        @endif

        {{-- NESSUNA NOTA --}}
        @if ($notes->isEmpty())
            {{-- ALERT INFO: Sostituisce .alert.alert-info --}}
            <div class="p-4 bg-blue-100 text-blue-800 text-center mt-8 rounded-lg" style="border-left: 5px solid #00b894;" role="alert">
                Nessuna nota presente. Inizia a creare la tua prima nota!
            </div>
        @else
            {{-- GRIGLIA DI CARD: Sostituisce .row.row-cols-* e .g-4 --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($notes as $note)
                    {{-- COLUMN ITEM: Sostituisce .col --}}
                    <div>
                        {{-- CARD: Sostituisce .card.shadow-sm.h-100 e gli stili inline --}}
                        <div class="bg-white shadow-lg h-full rounded-lg overflow-hidden" style="border-left: 5px solid {{ $note->is_pinned ? '#ffdd57' : '#343a40' }};">

                            {{-- CARD BODY: Sostituisce .card-body e le classi d-flex/flex-column --}}
                            <div class="p-5 flex flex-col h-full">

                                {{-- HEADER CARD: Sostituisce .d-flex.justify-content-between --}}
                                <div class="flex justify-between items-start mb-3">
                                    <h5 class="card-title text-truncate me-3 text-lg font-bold" style="color: #2c3e50;">
                                        {{ $note->title }}
                                        @if ($note->is_pinned)
                                            <span class="text-yellow-500 small ml-2">📌</span>
                                        @endif
                                    </h5>
                                    {{-- CREATED AT: Sostituisce .text-muted.small --}}
                                    <span class="text-gray-500 text-sm whitespace-nowrap">{{ $note->created_at->diffForHumans() }}</span>
                                </div>

                                {{-- CONTENUTO: Sostituisce .card-text.text-muted.mb-4 --}}
                                <p class="text-gray-600 mb-4 text-sm overflow-hidden line-clamp-3">{{ Str::limit($note->content, 100) }}</p>

                                {{-- BOTTONI: Sostituisce .mt-auto.d-flex.justify-content-end.space-x-2 --}}
                                <div class="mt-auto flex justify-end space-x-2 border-t pt-3">

                                    {{-- BOTTONE MODIFICA: Sostituisce .btn.btn-sm.btn-outline-primary --}}
                                    <a href="{{ route('notes.edit', $note) }}" class="px-3 py-1 text-sm border border-indigo-500 text-indigo-500 hover:bg-indigo-500 hover:text-white rounded-md transition duration-150">Modifica</a>

                                    {{-- FORM ELIMINA: Sostituisce .d-inline --}}
                                    <form action="{{ route('notes.destroy', $note) }}" method="POST" onsubmit="return confirm('Sei sicuro di voler eliminare questa nota?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        {{-- BOTTONE ELIMINA: Sostituisce .btn.btn-sm.btn-outline-danger --}}
                                        <button type="submit" class="px-3 py-1 text-sm border border-red-500 text-red-500 hover:bg-red-500 hover:text-white rounded-md transition duration-150">Elimina</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
