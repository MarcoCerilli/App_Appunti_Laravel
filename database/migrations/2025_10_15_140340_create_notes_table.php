<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
              // --- CORREZIONE: AGGIUNTA user_id per l'Autenticazione ---
            // 'foreignId' è la sintassi moderna e più sicura per le chiavi esterne.
            // 'constrained()' cerca automaticamente la tabella 'users'.
            // 'onDelete('cascade')' è fondamentale: se l'utente viene eliminato, tutte le sue note lo saranno.
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->timestamps();
            $table->string('title')->unique(); // Il titolo della nota (stringa corta)
            $table->text('content'); // Il contenuto della nota (testo lungo)
            $table->boolean('is_pinned')->default(false); // Campo booleano per 'fissare' la nota (utile per ordinamento)

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};
