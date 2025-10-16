@extends('index')

@section('title', 'Home')

@section('content')
<div class="jumbotron">
    <h1 class="display-4">Benvenuto su Laravel Appunti</h1>
    <p class="lead">Questa è la tua guida pratica per padroneggiare Blade, Condizionali e Direttive Laravel.</p>
    <hr class="my-4">
    <p>Utilizza il menu a sinistra per navigare tra le varie lezioni e approfondire i concetti.</p>
    <a class="btn btn-primary btn-lg" href="{{ route('condizionali') }}" role="button">Inizia Ora</a>
</div>
@endsection
