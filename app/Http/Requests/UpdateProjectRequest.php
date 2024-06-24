<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProjectRequest extends FormRequest
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
        return [
            // Rule::unique('projects')->ignore($this->id)
            'title' => 'required|min:5',
            'description' => 'nullable|min:10',
            'image' => 'required|image|mimes:png,jpg,jpeg',
            'site_url' => 'nullable|active_url',
            'start_date' => 'nullable|date|before_or_equal:today|required_with:finish_date',
            'finish_date' => 'nullable|date|after_or_equal:start_date',
        
        ];
    }

    public function messages() {
        return	[ 
            'title.required' => 'Il titolo è obbligatorio',
            'title.min' => 'Il titolo deve contenere almeno 5 caratteri',
            'description.min' => 'La descrizione deve contenere almeno 10 caratteri',
            'image.required' => "I'immagine è obbligatoria",
            'image.image' => "Inserire un immagine valida",
            'image.mimes' => "Formati supportati: jpg-jpeg-png",
            'site_url.active_url' => 'Il link del sito non è valido',
            'start_date.date' => 'Inserisci una data corretta',
            'start_date.before_or_equal' => 'Inserisci una data uguale o precedente a oggi',
            'start_date.required_with' => 'Inserisci una data corretta',
            'finish_date.after_or_equal' => 'Inserisci una data uguale o successiva a oggi',
            'finish.date' => 'Inserisci una data corretta',          

        ];
        
    }
}
