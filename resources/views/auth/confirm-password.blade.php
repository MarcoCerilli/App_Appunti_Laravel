<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conferma Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-md bg-white p-8 shadow-2xl rounded-xl">
        <h1 class="text-3xl font-bold text-indigo-700 mb-6 text-center">Conferma Password</h1>

        <p class="text-gray-600 mb-6 text-center">
            Questa è un'area riservata. Per continuare, inserisci la tua password.
        </p>

        <!-- Session Status (Utile per i messaggi di Laravel Breeze, ma lo manteniamo per consistenza) -->
        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.confirm') }}" class="space-y-6">
            @csrf

            <!-- Campo Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input
                    type="password"
                    name="password"
                    id="password"
                    class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 p-3 @error('password') border-red-500 @enderror"
                    required
                    autocomplete="current-password"
                >
                @error('password')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Bottone Submit -->
            <div class="flex justify-end">
                <button
                    type="submit"
                    class="w-full px-4 py-3 bg-indigo-600 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition duration-150"
                >
                    Conferma
                </button>
            </div>

            <!-- Link Password Dimenticata (Opzionale) -->
            @if (Route::has('password.request'))
                <div class="text-center pt-4 border-t mt-4">
                    <a href="{{ route('password.request') }}" class="text-sm text-indigo-600 hover:text-indigo-800">
                        Password dimenticata?
                    </a>
                </div>
            @endif
        </form>

    </div>
</body>
</html>
