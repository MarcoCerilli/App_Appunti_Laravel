<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ManualLoginController; // Manteniamo questo

/*
|--------------------------------------------------------------------------
| Rotte generate da Laravel Breeze (Se presenti)
|--------------------------------------------------------------------------
*/

// Rotta predefinita che punta alla dashboard dopo il login
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard'); // <-- RIMOSSO 'verified' QUI


// Rotte per la gestione dell'Autenticazione (login, register, reset, ecc.)
// require __DIR__.'/auth.php'; // Commentato se stai usando solo l'autenticazione manuale

// Rotta per il profilo utente
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


/*
|--------------------------------------------------------------------------
| Le Tue Rotte Personalizzate
|--------------------------------------------------------------------------
*/

// HOME (Rotta principale)
Route::get('/', function () {
    // Aggiungiamo un check per vedere chi è loggato
    if (Auth::check()) {
        $user = Auth::user();
        return view('welcome', ['user' => $user]); // Uso 'welcome' come fallback generico
    }
    return view('welcome', ['user' => null]);
})->name('home');


// Rotte NOTES (Risorsa protetta da 'auth')
Route::middleware('auth')->group(function () {
    Route::resource('notes', NoteController::class);
});


// ------------------------------------------------------------------
// ROTTE AUTENTICAZIONE MANUALE (Lezione 95-96)
// ------------------------------------------------------------------

// Rotte per l'accesso manuale (protette da 'guest')
Route::middleware('guest')->group(function () {
    Route::get('/manual-login', [ManualLoginController::class, 'showLoginForm'])->name('manual.login');
    Route::post('/manual-login', [ManualLoginController::class, 'login']);
});

// Rotta per il logout (usa il middleware 'auth' per proteggerla)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [ManualLoginController::class, 'logout'])->name('logout');
});


// Rotta per la lezione "Guards & Providers"
Route::get('/guards-providers', function () {
    return view('guards_providers');
})->name('Guards&Providers');


// ------------------------------------------------------------------
// VECCHIE ROTTE DIDATTICHE
// ------------------------------------------------------------------
Route::get('/condizionali', function () {
    return view('condizionali');
})->name('condizionali');

Route::get('/include', function () {
    //VARIABILE DI TEST
    $user_role = 'admin'; // Puoi cambiare in 'admin' per testare @includeUnless
    return view('include', compact('user_role'))                    ;
})->name('include');

Route::get('/ereditarieta', function () {
    return view('ereditarieta');
})->name('ereditarieta');

Route::get('/seeders', function () {
    return view('seeders');
})->name('seeders');

Route::get('/query-builder', function () {
    return view('query_builder');
})->name('query.builder');
