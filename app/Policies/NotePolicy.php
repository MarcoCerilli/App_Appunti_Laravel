<?php

namespace App\Policies;

use App\Models\Note;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class NotePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Note $note): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determina se l'utente può aggiornare il modello.
     * @param User $user Utente loggato
     * @param Note $note Modello su cui si sta tentando l'azione
     * @return bool|Response
     */
    public function update(User $user, Note $note): bool|Response
    {
        // La regola più importante: l'ID dell'utente loggato deve corrispondere all'user_id della nota.
        return $user->id === $note->user_id
            ? Response::allow()
            : Response::deny('Non sei autorizzato a modificare questa nota.');
    }

    /**
     * Determina se l'utente può eliminare il modello.
     * @param User $user Utente loggato
     * @param Note $note Modello su cui si sta tentando l'azione
     * @return bool|Response
     */
    public function delete(User $user, Note $note): bool|Response
    {
        // Stessa logica di update
        return $user->id === $note->user_id
            ? Response::allow()
            : Response::deny('Non sei autorizzato a modificare questa nota.');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Note $note): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Note $note): bool
    {
        return false;
    }
}
