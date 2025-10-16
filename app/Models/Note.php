<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'is_pinned',
        'user_id'
    ];

    // Trattiamo 'is_pinned' come booleano

    protected $casts = [

        'is_pinned' => 'boolean',
    ];

    // DEFINIAMO LA RELAZIONE CON UTENTE
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
