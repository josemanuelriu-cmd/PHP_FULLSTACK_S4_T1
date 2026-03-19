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
            'name' => 'required|string|min:5|max:255',
            'min_players' => 'required|integer|min:1',
            'max_players' => 'required|integer|min:1|gte:min_players',
            'min_age' => 'required|integer|min:6',
            'duration' => 'required|integer|min:1',
            'description' => 'nullable|string',
            'types' => 'nullable|array',
            'types.*' => 'exists:types,id'
        ];
    }
    
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
