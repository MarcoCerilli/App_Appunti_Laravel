<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ConfirmPasswordController extends Controller
{

    /**
     * MOSTRA LA VISTA DI CONFERMA DELLA PASSWORD.
     */
    public function showConfirmForm()
    {
        // Controlla se l'utente ha già confermato la password recentemente
        // La variabile di sessione 'auth.password_confirmed_at' è impostata dal middleware

        if (session('auth.password_confirmed_at')) {

            // Se la password è stata confermata reindirizzal'utente alla destinazione originale
            return redirect()->intended(route('notes.index'));
        }

        return view('auth.confirm-password');
    }

    /**
     * GESTISCE LA SOTTOMISSIONE DEL FORM DI CONFERMA PASSWORRD.
     */
    public function confirm(Request $request)
    {
        //1. VALIDAZIONE DELLA RICHIESTA
        $request->validate([
            'password' => ['required', 'string'],
        ]);

        // 2. Verifica che la password fornita corrisponda a quella dell'utente loggato.
        // Usiamo Auth::guard('web')->validate([]) per verificare la password SENZA loggare di nuovo l'utente.
        if (! Auth::guard('web')->validate([
            'email' => $request->user()->email,
            'password' => $request->password,
        ])) {
            //Se la password non corrisponde, lancia un errore di validazione
            throw ValidationException::withMessages([
                'password' => __('La passowrd fornita non è corretta!'),
            ]);
        }

        //3. Password Corretta: memorizzail timestammp in sessione
        // Questo sblocca il middleware 'password.confirm' per un periodo (di default 3 ore).

        $request->session()->put('auth.password_confirmed_at', time());

        // 4. Reindirizza l'utente alla destinazione desiderata (quella che lo aveva bloccato)
        return redirect()->intended(route('notes.index'));
    }












    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
