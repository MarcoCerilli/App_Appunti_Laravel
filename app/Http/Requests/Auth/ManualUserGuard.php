<?php

namespace App\Auth;

use Illuminate\Auth\GuardHelpers;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class ManualUserGuard implements Guard
{
    use GuardHelpers;

    protected UserProvider $provider;
    protected Session $session;

    // Chiave di sessione per memorizzare l'ID utente
    protected string $sessionKey = 'login_web_manual';

    public function __construct(UserProvider $provider, Session $session)
    {
        $this->provider = $provider;
        $this->session = $session;
    }

    /**
     * Recupera l'utente autenticato.
     */
    public function user()
    {
        // Se l'utente è già stato caricato, lo restituisce
        if (! is_null($this->user)) {
            return $this->user;
        }

        // Tenta di recuperare l'ID utente dalla sessione
        $id = $this->session->get($this->sessionKey);

        // Se l'ID esiste, usa il provider per caricare l'utente dal database
        if (! is_null($id)) {
            return $this->user = $this->provider->retrieveById($id);
        }

        return null;
    }

    /**
     * Tenta di autenticare l'utente con le credenziali fornite.
     */
    public function attempt(array $credentials = [], $remember = false)
    {
        // 1. Cerca l'utente in base alle credenziali (es. email)
        $user = $this->provider->retrieveByCredentials($credentials);

        // 2. Se l'utente esiste e la password è corretta
        if ($this->hasValidCredentials($user, $credentials)) {

            // 3. Esegue il login e restituisce true
            $this->login($user, $remember);
            return true;
        }

        return false;
    }

    /**
     * Esegue il login dell'utente.
     */
    public function login($user, $remember = false)
    {
        $this->user = $user;

        // Memorizza l'ID utente nella sessione per mantenerlo loggato
        $this->session->put($this->sessionKey, $user->getAuthIdentifier());

        // Puoi implementare qui la logica 'Remember Me' se necessario
    }

    /**
     * Determina se l'utente è stato autenticato.
     */
    public function check()
    {
        return ! is_null($this->user());
    }

    /**
     * Determina se le credenziali sono valide.
     */
    protected function hasValidCredentials($user, $credentials)
    {
        return ! is_null($user) && $this->provider->validateCredentials($user, $credentials);
    }

    /**
     * Logout dell'utente (cancella la sessione).
     */
    public function logout()
    {
        $this->session->forget($this->sessionKey);
        $this->user = null;
    }

    // Gli altri metodi di Guard rimangono inutilizzati per questa implementazione manuale
    public function validate(array $credentials = [])
    {
        // Non implementato in questo esempio
    }

    public function once(array $credentials = [])
    {
        // Non implementato in questo esempio
    }

    public function viaRemember()
    {
        // Non implementato in questo esempio
    }

    public function hasUser()
    {
        return ! is_null($this->user);
    }
}
