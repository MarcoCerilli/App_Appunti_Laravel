<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * 1. MOSTRA TUTTE LE NOTE
     */
    public function index()
    {
        // Ordina le note: prima le pinned (fissate) e poi le altre per ID decrescente
        $notes = Note::orderBy('is_pinned', 'desc')
                    ->orderBy('id', 'desc')
                    ->get();
        return view('notes.index', compact('notes'));
    }

    /**
     * 2. MOSTRA FORM CREAZIONE (GET/notes/create)
     */
    public function create()
    {
        return view('notes.create');
    }

    /**
     * 3. SALVA NUOVA NOTA (POST /notes)
     */
    public function store(StoreNoteRequest $request)
    {
        $note = Note::create($request->validated());
        return redirect()->route('notes.index')->with('SUCCESS', 'NOTA CREATO CON SUCCESSO!');
    }

    /**
     *  4.DETTAGLIO NOTA (GET/notes/{{note}})
     */
    public function show(Note $note)
    {
        return view('notes.show', compact('note'));
    }

    /**
     *   // 5. MOSTRA FORM MODIFICA (GET /notes/{note}/edit)
     */
    public function edit(Note $note)
    {
        return view('notes.edit', compact('note'));
    }

    /**
     *   // 6. AGGIORNA NOTA (PUT/PATCH /notes/{note})
     */
    public function update(UpdateNoteRequest $request, Note $note)
    {
        $note->update($request->validated());
        return redirect()->route('notes.index', $note)->with('SUCCESSO', 'NOTA AGGIORNATA CON SUCCESSO');


    }

    /**
     *    // 7. ELIMINA NOTA (DELETE /notes/{note})
     */
    public function destroy(Note $note)
    {
        $note->delete();
        return redirect()->route('notes.index', $note)->with('SUCCESSO', 'NOTA ELIMINATA CON SUCCESSO');
    }
}
