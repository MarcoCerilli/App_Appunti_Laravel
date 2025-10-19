<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ManualLoginController extends Controller
{

    /**
     * Esegue il login forzato come Amministratore (ID 1)
     * e reindirizza all'area protetta.
     */
    public function loginAsAdmin()
    {
        //1. Trova l'utente che vuoi autenticare(ID 1)
        $user = User::findOrFail(1);

        //2. Stabilisce la sessione: logga l'utente forzatamente
        Auth::login($user);

         // 3. Reindirizza l'utente alla dashboard admin
        // Il middleware 'admin' verrà eseguito su questa rotta di destinazione
        return redirect()->route('admin.index');
    }


 /**
     * Esegue il login forzato come Utente Standard (ID 2)
     * e reindirizza alla dashboard standard.
     */
    public function loginAsUser()
    {
        // 1. Trova l'utente che vuoi autenticare (ID 2)
        $user = User::findOrFail(2);

         // 2. STABILISCE LA SESSIONE: Logga l'utente forzatamente
        Auth::login($user);
        return redirect()->route('dashboard');

    }


    /**
     * Effettua il logout dell'utente.
     */
    public function logout(Request $request)
    {
        // 1. Logout dell'utente (rimuove l'autenticazione dalla sessione)
        Auth::logout();

        // 2. Invalida completamente la sessione
        $request->session()->invalidate();

        // 3. Rigenera il token CSRF per le future richieste
        $request->session()->regenerateToken();

        // 4. Reindirizza l'utente alla home
        return redirect('/');
    }
}
