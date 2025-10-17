<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class EmailVerificationController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        // Controlla se l'utente ha già verificato l'email
        if ($request->user()->hasVerifiedEmail()) {
            // Reindirizza l'utente alla dashboard
            return redirect()->intended(route('dashboard')); // <--- Utilizziamo 'dashboard'
        }

        // Se l'email viene marcata come verificata
        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        // Reindirizza l'utente alla dashboard dopo la verifica
        // Aggiungiamo anche un parametro 'verified' per gestire eventuali messaggi nella view
        return redirect()->intended(route('dashboard', absolute: false) . '?verified=1'); // <--- Utilizziamo 'dashboard' e aggiungiamo ?verified=1
    }
}
