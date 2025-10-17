<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ManualLoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function showLoginForm()
    {
        //Se l'utente è autenticato, rendirizziamo alla home
        if (Auth::check()) {
            return redirect('/');
        }
        return view('auth.manual-login');
    }

    /**
     *   GESTISCE IL TENTATIVO DI LOGIN MANUALE
     */
    public function login(Request $request)
    {
        //1. Validazione dei dati
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Tentativo di autenticazione tramite il guard 'web' (di default)
        if (Auth::attempt($credentials)) {

             // Rigenera la sessione per prevenire attacchi di Session Fixation
            $request->session()->regenerate();

           // *** NUOVA RIGA: Imposta la sessione di conferma password ***
            // Questa riga dice a Laravel che la password è stata appena verificata,
            // evitando la richiesta di conferma immediata dopo il login.
            $request->session()->put('auth.password_confirmed_at', time());


            // reindirizziamo a una pagina sicura
            return redirect()->intended('/');
        }

        // 3.Fallimento:  Ritorna al form con un messaggio di errore
        return back()->withErrors([
            'email' => 'Le credenziali fornite non sono corrette.',
        ])->onlyInput('email');
    }


    /**
     * Update the specified resource in storage.
     */
    public function logout(Request $request)
    {
        //esegue il logout distruggendo la sessione di autenticazione
        Auth::logout();

        //Invalida la sessione attuale
        $request->session()->invalidate();

        // Rigenera il token CSRF
        $request->session()->regenerateToken();

        // Reindirizza l'utente alla pagina di Login o Home
        return redirect()->route('manual.login');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
