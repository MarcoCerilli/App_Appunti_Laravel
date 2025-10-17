<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pannello di Amministrazione</title>
    <style>
        body { font-family: sans-serif; padding: 20px; background-color: #f4f4f9; }
        .container { max-width: 800px; margin: 0 auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        h1 { color: #333; border-bottom: 2px solid #5cb85c; padding-bottom: 10px; }
        .alert-success { background-color: #dff0d8; color: #3c763d; border: 1px solid #d6e9c6; padding: 15px; margin-bottom: 20px; border-radius: 4px; }
        .admin-content { background-color: #e6ffe6; padding: 20px; border-left: 5px solid #5cb85c; }
        .denied-content { background-color: #ffe6e6; padding: 20px; border-left: 5px solid #d9534f; }
        code { background-color: #eee; padding: 2px 4px; border-radius: 3px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Pannello di Amministrazione</h1>

        @if (session('status'))
            <div class="alert-success">
                {{ session('status') }}
            </div>
        @endif

        <p>Benvenuto, {{ Auth::user()->name }}. Il tuo ID è: <strong>{{ Auth::id() }}</strong>.</p>
        <p><a href="/logout" style="color: #d9534f;">Logout</a></p>

        <h2>Test del Gate: 'access-admin'</h2>

        {{-- La direttiva @can viene usata per mostrare/nascondere il contenuto --}}
        @can('access-admin')
            <div class="admin-content">
                <h3>Accesso Admin Garantito!</h3>
                <p>Congratulazioni! Sei autorizzato ad accedere a questo contenuto protetto dal Gate <code>access-admin</code>.</p>
                <p>Questo blocco è visibile solo se il Gate restituisce **true** (come per l'utente ID 1).</p>
            </div>
        @else
            <div class="denied-content">
                <h3>Accesso Limitato</h3>
                <p>Sei loggato, ma l'accesso a questa sezione è stato **negato** dal Gate <code>access-admin</code>.</p>
                {{-- *** LA CORREZIONE È QUI SOTTO *** --}}
                <p>Sezione NON VISIBILE. Questo è il blocco <code>@@else</code> del <code>@@can</code>, visibile agli utenti con ID diverso da 1.</p>
                {{-- Notare il doppio @ (@@) per visualizzare il simbolo @ come testo. --}}
            </div>
        @endcan

    </div>
</body>
</html>
