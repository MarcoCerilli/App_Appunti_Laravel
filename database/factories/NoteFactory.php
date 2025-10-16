<?php

namespace Database\Factories;

use App\Models\Note;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Note>
 */
class NoteFactory extends Factory
{
    protected $model = Note::class;


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [

            'title' => rtrim($this->faker->unique()->sentence(rand(3, 7)), '.'),

            // LA RIGA FONDAMENTALE PER RISOLVERE L'ERRORE 1364
            // Prende un ID utente esistente a caso.
            'user_id' => User::inRandomOrder()->first()->id,

            'content' => $this->faker->paragraphs(rand(3, 8), true),
            'is_pinned' => $this->faker->boolean(20),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),

        ];
    }
}
