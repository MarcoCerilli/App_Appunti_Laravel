<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AdminController extends Controller
{
    /**
     * Mostra la pagina di amministrazione, gestendo l'accesso negato.
     */
    public function index()
    {
        // 1. Definisci le variabili iniziali per la vista
        $isAdmin = false;
        $messageTitle = 'Area Riservata';
        $messageContent = 'Devi essere un amministratore per accedere a questa sezione.';
        $statusClass = 'bg-red-100 text-red-800';
        $statusIcon = '❌';


        // 2. Controllo il Gate 'admin'
        if (Gate::allows('admin')) {
            //Se l'utente è un ADMIN
            $isAdmin = true;
            $messageTitle = 'Area di Amministrazione Protetta';
            $messageContent = 'ADMIN: Accesso garantito dal Gate! Qui puoi caricare i contenuti riservati solo all\'Amministratore.';
            $statusClass = 'bg-green-100 text-green-800';
            $statusIcon = '✅';
        }
        // 3. Ritorna la vista, passandogli tutte le variabili di stato
        return view('admin.index', [
            $isAdmin = $isAdmin,
            $messageTitle = $messageTitle,
            $messageContent = $messageContent,
            $statusClass = $statusClass,
            $statusIcon = $statusIcon

        ]);
    }
}
