<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //1. Verifichiamo se l'utente è autenticato
        if (!Auth::check()) {
            // Se non è loggato, reindirizziamoal login('il middleware auth fa gia questo')
            return redirect('/login');
        }

        // 2. Utilizziamo il Gate 'access-admin' per la verifica.
        // Se l'utente NON può accedere come admin, neghiamo l'accesso.
        if (Gate::denies('access-admin')) {
            //reindirizziamo l'utente alla dashboard principale con un messaggio di errore
            return redirect('/dashboard')->with('error, Accesso negato!');
        }
        // 3.L'utente ha i permessi (il Gate è passato). Procediamo
        return $next($request);
    }
}
