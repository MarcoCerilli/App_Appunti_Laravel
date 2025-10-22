@extends('index') {{-- Utilizza il layout 'guest' specificato nella tua bozza --}}

@section('title', 'Lezione: Storage, Sessioni e Cache')

@section('content')
    {{-- Include il contenuto specifico della lezione (il partial) --}}
    @include('partials.storage_sessioni_cache_content')
@endsection
