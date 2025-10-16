@extends('index')

@section('title', 'Query Builder')
@section('active-query_builder', 'active')

@section('content')
    {{--
        Wrapper per il contenuto della lezione.
        Utilizza padding, sfondo e ombra per definire l'area di lezione.
    --}}
    <div class="p-6 lg:p-8 bg-white shadow-md rounded-lg">
        @include('partials.lesson', [
            'title' => 'Query Builder in Laravel',
            'description' => 'Il Query Builder di Laravel offre un\'interfaccia fluida per costruire query SQL in modo semplice e sicuro.',
            'lessons' => [
                [
                    'title' => '1️⃣ Recuperare tutti i record',
                    'code' => "use Illuminate\\Support\\Facades\\DB;\n\n\$users = DB::table('users')->get();"
                ],
                [
                    'title' => '2️⃣ Filtrare i dati',
                    'code' => "\$users = DB::table('users')\n    ->where('status', 'active')\n    ->where('age', '>', 18)\n    ->get();"
                ],
                [
                    'title' => '3️⃣ Selezionare colonne specifiche',
                    'code' => "\$users = DB::table('users')\n    ->select('name', 'email')\n    ->get();"
                ],
                [
                    'title' => '4️⃣ Ordinare risultati',
                    'code' => "\$users = DB::table('users')\n    ->orderBy('created_at', 'desc')\n    ->get();"
                ],
                [
                    'title' => '5️⃣ Paginazione',
                    'code' => "\$users = DB::table('users')\n    ->paginate(10);"
                ],
                [
                    'title' => '6️⃣ Aggregazioni',
                    'code' => "\$count = DB::table('users')->count();\n\$maxAge = DB::table('users')->max('age');\n\$avgAge = DB::table('users')->avg('age');"
                ],
                [
                    'title' => '7️⃣ Join tra tabelle',
                    'code' => "\$users = DB::table('users')\n    ->join('posts', 'users.id', '=', 'posts.user_id')\n    ->select('users.name', 'posts.title')\n    ->get();"
                ],
                [
                    'title' => '8️⃣ Inserimento, aggiornamento ed eliminazione',
                    'code' => "// Inserimento\nDB::table('users')->insert([\n    'name' => 'Marco',\n    'email' => 'marco@example.com',\n    'created_at' => now(),\n    'updated_at' => now()\n]);\n\n// Aggiornamento\nDB::table('users')\n    ->where('id', 1)\n    ->update(['name' => 'Marco Cerilli']);\n\n// Eliminazione\nDB::table('users')->where('id', 1)->delete();"
                ],
                [
                    'title' => '9️⃣ Raw queries',
                    'code' => "\$users = DB::select(DB::raw(\"SELECT * FROM users WHERE age > ?\", [18]));"
                ],
            ]
        ])
    </div>
@endsection
