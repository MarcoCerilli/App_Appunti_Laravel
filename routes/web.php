<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ConfirmPasswordController;
use App\Http\Controllers\ManualLoginController;

/*
|--------------------------------------------------------------------------
| Rotta Principale: HOME (Gestione Accesso)
|--------------------------------------------------------------------------
*/

// HOME (Rotta principale)
Route::get('/', function () {
    // Se l'utente è loggato, reindirizza direttamente alla dashboard protetta.
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }

    // Se l'utente NON è loggato, mostra la pagina 'welcome' (Landing Page).
    return view('welcome', ['user' => null]);
})->name('home');


// Rotte per la gestione dell'Autenticazione (login, register, reset, ecc.)
require __DIR__ . '/auth.php';

// ------------------------------------------------------------------
// ROTTE AUTENTICAZIONE MANUALE (Lezione 95-96)
// ------------------------------------------------------------------

// Rotte per l'accesso manuale (protette da 'guest')
Route::middleware('guest')->group(function () {
    Route::get('/manual-login', [ManualLoginController::class, 'showLoginForm'])->name('manual.login');
    Route::post('/manual-login', [ManualLoginController::class, 'login']);
});

// Logout manuale
Route::post('/logout', [ManualLoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');


/*
|--------------------------------------------------------------------------
| GRUPPO DI ROTTE PROTETTE (AUTENTICATE E VERIFICATE)
|--------------------------------------------------------------------------
| Richiedono: 'auth' (loggato) e 'verified' (email verificata).
*/

Route::middleware(['auth', 'verified'])->group(function () {

    // 1. DASHBOARD (Nuova Home per Utente Loggato)
    Route::get('/dashboard', function () {
        // Controlla se c'è un messaggio di errore proveniente dal middleware Admin
        $error = session('error');
        return view('dashboard', [
            'error_message' => $error,
            'user_role' => (Auth::id() == 1 ? 'Admin' : 'Standard')
        ]);
    })->name('dashboard');


    // 2. Rotte per il profilo utente
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    // 3. Rotte per la Conferma Password (Lezione 101)
    Route::get('/confirm-password', [ConfirmPasswordController::class, 'showConfirmForm'])
        ->name('password.confirm');

    Route::post('/confirm-password', [ConfirmPasswordController::class, 'confirm']);

    // --- Rotte delle Note ---
    // Rotte meno sensibili (visualizzazione e creazione) non richiedono conferma password
    Route::resource('notes', NoteController::class)->only(['index', 'show', 'create', 'store']);

    Route::middleware(['password.confirm'])->group(function () {
        // Rotte sensibili (modifica e eliminazione) richiedono la conferma password
        Route::get('notes/{note}/edit', [NoteController::class, 'edit'])->name('notes.edit');
        Route::put('notes/{note}', [NoteController::class, 'update'])->name('notes.update');
        Route::delete('notes/{note}', [NoteController::class, 'destroy'])->name('notes.destroy');
    });


    // 4. ROTTE DIDATTICHE
    Route::get('/condizionali', function () {
        return view('condizionali');
    })->name('condizionali');

    Route::get('/include', function () {
        $user_role = 'admin';
        return view('include', compact('user_role'));
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

    Route::get('/guards.providers', function () {
        return view('guards_providers');
    })->name('guards.providers');

    Route::get('/service-providers', function () {
        return view('service_providers');
    })->name('service.providers');

    // ** NUOVA ROTTA DIDATTICA: AUTH FLESSIBILE (LEZIONE 121) **
    Route::get('/auth-flexible', function () {
        return view('lesson_121_index');
    })->name('auth.flexible');
    // ROTTE PER LA LEZIONE SU STORAGE, SESSIONI E CACHE (LEZIONI 117-129)
    // Uso un unico file blade per l'introduzione, visto che sono molte lezioni
    Route::get('/storage-sessions-cache', function () {
        return view('storage_sessioni_cache');
    })->name('storage.sessioni.cache');

    Route::get('/lezione-notifiche-email', function () {
       //Nome della vista che contiene il contenuto della lezione
        return view('lezione_notifiche_email');
    })->name('lezioni.notifiche_email');
}); // Fine del Gruppo di Rotte Protette ['auth', 'verified']

Route::get('/appunti/comunicazioni', function () {
       //Nome della vista che contiene il contenuto della lezione
        return view('lezione_comunicazioni');
    })->name('appunti.comunicazioni');


/*
|--------------------------------------------------------------------------
| ROTTA ADMIN (PROTETTA DAL MIDDLEWARE 'admin' DEDICATO)
|--------------------------------------------------------------------------
| La rotta '/admin' è mantenuta, ma punta a un Controller
| che gestisce internamente l'autorizzazione (come da lezione).
*/

// La rotta '/admin' mantiene i middleware base di auth e verified.
// Il controllo 'admin' avviene all'interno di AdminController::index.
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])
        ->name('admin.index');
});


/*
|--------------------------------------------------------------------------
| Rotte di utilità per simulare l'accesso (CON EMAIL GIA' VERIFICATA)
|--------------------------------------------------------------------------
*/

// Login come Super Admin (ID 1)
Route::get('/login/admin', function () {
    $user = User::firstOrCreate(['id' => 1], [
        'name' => 'Super Admin',
        'email' => 'admin@example.com',
        'password' => Hash::make('testpassword'),
        'email_verified_at' => now(), // ✅ CORRETTO: Imposta la mail come verificata per test
    ]);
    Auth::login($user);
    return redirect()->route('dashboard')
        ->with('status', 'Sei ora loggato come Super Admin (ID 1).');
})->name('test.login.admin');

// Login come Utente Standard (ID 2)
Route::get('/login/user', function () {
    $user = User::firstOrCreate(['id' => 2], [
        'name' => 'Utente Standard',
        'email' => 'user@example.com',
        'password' => Hash::make('testpassword'),
        'email_verified_at' => now(), // ✅ CORRETTO: Imposta la mail come verificata per test
    ]);
    Auth::login($user);
    return redirect()->route('dashboard')
        ->with('status', 'Sei ora loggato come Utente Standard (ID 2).');
})->name('test.login.user');

// Logout (Rotta di utilità)
Route::get('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/')->with('status', 'Logout effettuato.');
})->name('test.logout');

// Rotta di Debug Autenticazione
Route::get('/test-auth', function () {
    if (Auth::check()) {
        return 'Sei loggato. User ID: ' . Auth::id() . '. Ruolo: ' . (Auth::id() == 1 ? 'ADMIN' : 'STANDARD');
    }
    return redirect('/');
})->middleware('auth');
