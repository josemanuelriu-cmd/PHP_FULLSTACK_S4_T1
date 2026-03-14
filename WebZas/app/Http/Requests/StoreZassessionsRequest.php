<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreZassessionsRequest extends FormRequest
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
            'date' => 'required|date|after_or_equal:today|unique:zassessions,date',
            'name' => 'required|string|min:3|max:255',
            'event_name' => 'nullable|string|min:3|max:255',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'max_users' => 'required|integer|min:1',
            'direction' => 'required|string|min:5|max:255',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180'
        ];
    }
    public function attributes(): array
    {
        return [
            'date' => 'fecha',
            'name' => 'lugar',
            'event_name' => 'evento',
            'start_time' => 'hora de inicio',
            'end_time' => 'hora de finalización',
            'max_users' => 'máximo de usuarios',
            'direction' => 'dirección',
            'latitude' => 'latitud',
            'longitude' => 'longitud'
        ];
    }
}
