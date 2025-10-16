<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateNoteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // Otteniamo il modello Note iniettato dalla rotta per ignorarlo nella validazione 'unique'
        $noteId = $this->route('note');

        // Se $noteId è un oggetto, usiamo il suo ID, altrimenti usiamo il valore grezzo (per la sicurezza dell'IDE)
        $idValue = is_object($noteId) ? $noteId->id : $noteId;

        return [
            'title' => [
                'required',
                'string',
                'max:100',
                //Ignora la nota corrente perche la sto modificando
                Rule::unique('notes')->ignore($idValue),
            ],
            'content' => ['required', 'string'],
            'is_pinned' => ['nullable', 'boolean']
        ];
    }
}
