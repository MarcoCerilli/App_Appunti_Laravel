<?php

namespace App\Providers;

use App\Models\Note;
use App\Models\User; // Importa il modello User
use App\Policies\NotePolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
     /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Note::class => NotePolicy::class,

    ];

    public function boot()
    {
        $this->registerPolicies();

        // -----------------------------------------------------------------------
        // UTILIZZIAMO SOLO Gate::define PER TESTARE LA LOGICA
        // -----------------------------------------------------------------------
        Gate::define('access-admin', function (User $user) {

            // 🚨 DD DI TEST FINALE: Controlla se l'ID è 1
        //    dd('Gate::define chiamato. User ID:', $user->id);

            // Accesso consentito per l'ID 1 (Super Admin)
            if ($user->id == 1) {
                return true;
            }

            // Accesso negato per tutti gli altri
            return false;
        });
    }
}
