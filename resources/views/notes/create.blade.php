@extends('index') {{-- ESTENDE IL TUO LAYOUT PRINCIPALE --}}

@section('title', 'Crea Nuova Nota')

@section('content')
    {{-- LAYOUT E CENTRATURA: Sostituisce .row e .justify-content-center --}}
    <div class="flex justify-center my-8">
        {{-- COLONNA: Sostituisce .col-md-9 e centra il contenuto (max-w-3xl è circa 48rem) --}}
        <div class="w-full max-w-3xl">

            {{-- CARD: Sostituisce .card.shadow-lg e gli stili inline --}}
            <div class="bg-white shadow-xl rounded-xl overflow-hidden">

                {{-- CARD HEADER: Sostituisce .card-header e gli stili inline --}}
                <div class="p-6 text-white" style="background-color: #6c5ce7;">
                    <h3 class="text-xl font-semibold mb-0">Crea Nuova Nota</h3>
                </div>

                <div class="p-6">
                    {{-- TORNA ALLE NOTE: Sostituisce .btn.btn-link --}}
                    <a href="{{ route('notes.index') }}" class="text-indigo-600 hover:text-indigo-800 font-medium mb-4 inline-block">
                        &larr; Torna alle Note
                    </a>

                    <form action="{{ route('notes.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            {{-- LABEL: Sostituisce .form-label --}}
                            <label for="title" class="block text-sm font-medium text-gray-700">Titolo</label>

                            {{-- INPUT: Sostituisce .form-control e .is-invalid --}}
                            <input type="text" name="title" id="title" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('title') border-red-500 @enderror" value="{{ old('title') }}" required>

                            {{-- GESTIONE ERRORE: Usa il componente di Breeze --}}
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            {{-- LABEL --}}
                            <label for="content" class="block text-sm font-medium text-gray-700">Contenuto</label>

                            {{-- TEXTAREA --}}
                            <textarea name="content" id="content" rows="8" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('content') border-red-500 @enderror" required>{{ old('content') }}</textarea>

                            {{-- GESTIONE ERRORE --}}
                            <x-input-error :messages="$errors->get('content')" class="mt-2" />
                        </div>

                        <div class="flex items-center mb-4 pt-3 border-t border-gray-200">
                            <input type="hidden" name="is_pinned" value="0">

                            {{-- CHECKBOX: Sostituisce .form-check-input --}}
                            <input type="checkbox" name="is_pinned" id="is_pinned" value="1" class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500" {{ old('is_pinned') ? 'checked' : '' }}>

                            {{-- LABEL: Sostituisce .form-check-label --}}
                            <label for="is_pinned" class="ml-2 block text-sm text-gray-900">Fissa questa nota (Importante)</label>
                        </div>

                        {{-- LAYOUT E BOTTONE: Sostituisce .d-flex e .btn --}}
                        <div class="flex justify-end mt-6">
                            <button type="submit" class="text-white font-semibold py-3 px-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300" style="background-color: #00b894; border: none;">
                                Salva Nota
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
