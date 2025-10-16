<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Utente di test principale
        User::create([
            'name' => 'Marco Cerilli',
            'email' => 'admin@appunti.com',
            'password' => Hash::make('Reddino24'), // Accesso con: admin@appunti.com / password
            'email_verified_at' => now()
        ]);
        // Utente di test secondario
        User::create([
            'name' => 'Luca Bianchi',
            'email' => 'test@appunti.com',
            'password' => Hash::make('password'), // Accesso con: admin@appunti.com / password
            'email_verified_at' => now()
        ]);

        // Crea 9 utenti fittizi aggiuntivi per test multi-utente
        User::factory(9)->create();
    }
}
