<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Authentication Guard
    |--------------------------------------------------------------------------
    |
    | This option controls the default authentication "guard" and password
    | reset options for your application. You may change these defaults
    | as required, but they're a perfect start.
    |
    */

    'defaults' => [
        // !!! MODIFICA CRUCIALE: Usiamo il nostro guard manuale di default
        'guard' => 'web', // Lasciamo 'web', ma lo configureremo sotto per usare 'manual'
        'passwords' => 'users',
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | Next, you may define every authentication guard for your application.
    | Of course, a great starting point is the "web" guard which uses
    | session storage and the Eloquent user provider.
    |
    */

    'guards' => [
        'web' => [
            // !!! MODIFICA CRUCIALE: Il guard 'web' ora usa il driver 'manual'
            'driver' => 'manual',
            'provider' => 'users',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | All authentication providers for your application will be configured here.
    | You can add as many as you want and you can even define your own.
    |
    | Laravel has several great providers and you are free to modify them.
    |
    */

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],

        // 'users' => [
        //     'driver' => 'database',
        //     'table' => 'users',
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    |
    | You may specify how the password reset functionality should work for
    | any of your password brokers and providers. You may also set the
    | number of seconds before a reset token expires.
    |
    */

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    |
    | Here you may define the amount of seconds before a password confirmation
    | times out and the user is prompted to re-enter their password via the
    | confirmation screen. By default, the timeout lasts for three hours.
    |
    */

    'password_timeout' => 10800,

];
