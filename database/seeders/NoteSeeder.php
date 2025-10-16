<?php

namespace Database\Seeders;

use App\Models\Note;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class NoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Otteniamo una collezione di tutti gli ID degli utenti esistenti
        $userIds = User::pluck('id');

        //// Se non ci sono utenti (non dovrebbe accadere se UserSeeder è eseguito prima)
        if($userIds->isEmpty())
        {
            return;
        }

        //Creiamo 50 note associando ad ognuna un user_id casuale
        Note::factory(50)->create([
            'user_id' => function(array $attributes) use ($userIds)
            {

                //Scegliamo un ID utente casuale dalla lista
                return $userIds->random();
            }
        ]);

    }
}
