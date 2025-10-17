<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AdminController extends Controller
{
    /**
     * Mostra il pannello di amministrazione.
     * Accesso protetto dal Gate 'view-admin-panel'.
     */
    public function index()
    {
        // 1. Applica la logica al Gate
        // 2. Se l'utente non ha il permesso 'view-admin-panel', questa riga lancia un eccezione HttpException 403
        // e blocca l' esecuzione.
       // Gate::authorize('access-admin');

        // Se l'esecuzione arriva qui, l'utente è autorizzato.
        return view('admin.index');
    }
}
