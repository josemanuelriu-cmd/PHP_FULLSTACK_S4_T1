<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBoardgameRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; //lo cambiamos a true para permitir que cualquier usuario pueda realizar esta solicitud. Lo validamos luego en rules
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:5|max:255', //['required', 'string', 'min:5', 'max:255'] //se pueden usar ambas formas
            'slug' => 'required|string|min:5|max:255|unique:boardgames,slug',
            'min_players' => 'required|integer|min:1',
            'max_players' => 'required|integer|min:1|gte:min_players',
            'min_age' => 'required|integer|min:6',
            'duration' => 'required|integer|min:1',
            'description' => 'nullable|string'
        ];
    }
    /*
    --quitado porque ahora lo hacemos con traducciones en resources/lang/es/validation.php
    public function messages(): array
    {
        return [
            'name.required' => 'El :attribute es obligatorio.',
            'name.string' => 'El :attribute debe ser una cadena de texto.',
            'name.min' => 'El :attribute debe tener al menos :min caracteres.',
            'name.max' => 'El :attribute no puede tener más de :max caracteres.',
            'slug.required' => 'El :attribute es obligatorio.',
            'slug.string' => 'El :attribute debe ser una cadena de texto.',
            'slug.min' => 'El :attribute debe tener al menos :min caracteres.',
            'slug.max' => 'El :attribute no puede tener más de :max caracteres.',
            'slug.unique' => 'El :attribute ya existe. Por favor, elige otro :attribute único.',
            'min_players.required' => 'El :attribute es obligatorio.',
            'min_players.integer' => 'El :attribute debe ser un entero.',
            'min_players.min' => 'El :attribute debe ser al menos :min.',
            'max_players.required' => 'El :attribute es obligatorio.',
            'max_players.integer' => 'El :attribute debe ser un entero.',
            'max_players.min' => 'El :attribute debe ser al menos :min.',
            'max_players.gte' => 'El :attribute debe ser mayor o igual que el número mínimo de jugadores.',
            'min_age.required' => 'La :attribute es obligatoria.',
            'min_age.integer' => 'La :attribute debe ser un entero.',
            'min_age.min' => 'La :attribute debe ser al menos :min años.',
            'duration.required' => 'La :attribute es obligatoria.',
            'duration.integer' => 'La :attribute debe ser un entero.',
            'duration.min' => 'La :attribute debe ser al menos :min minutos.',
            'description.string' => 'La :attribute debe ser una cadena de texto.'
        ];
    }*/
    public function attributes(): array
    {
        return [
            'name' => 'nombre del juego',
            'slug' => 'slug del juego',
            'min_players' => 'número mínimo de jugadores',
            'max_players' => 'número máximo de jugadores',
            'min_age' => 'edad mínima',
            'duration' => 'duración del juego',
            'description' => 'descripción del juego'
        ];
    }
}
