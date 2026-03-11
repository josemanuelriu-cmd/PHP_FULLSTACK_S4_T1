<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGameRequest extends FormRequest
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
            //'zassession_id' => 'required|integer', 
            'boardgame_id' => 'required|integer',
            //'host_user_id' => 'required|integer',
            //'max_players' => 'required|integer|min:1',
            'start_time' => 'required|date_format:H:i',
            'status' => 'required|string'
            //'necesary_know_how' => 'required|boolean'
        ];
    }
    public function attributes(): array
    {
        return [
            'zassession_id' => 'zassession_id',
            'boardgame_id' => 'boardgame_id',
            'host_user_id' => 'host_user_id',
            'max_players' => 'número máximo de jugadores',
            'start_time' => 'hora de inicio',
            'status' => 'tipo partida',
            'necesary_know_how' => 'necesario saber jugar'
        ];
    }
}
