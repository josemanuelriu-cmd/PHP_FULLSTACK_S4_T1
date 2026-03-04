<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute as CastsAttribute;

class Sessions_zas extends Model
{
    protected $table = 'sessions_zas';

    protected $fillable = ['date', 'start_time', 'end_time', 'max_users', 'direction', 'latitude', 'longitude'];

    protected function direction(): CastsAttribute
    {
        return CastsAttribute::make(
            get: fn ($value) => ucwords($value), //Convierte el valor a mayúscula cada palabra al obtenerlo
            set: fn ($value) => strtolower($value) //Convierte el valor a minúscula al establecerlo
        );

    }
     protected function casts(): array
     {
        return [
            'date' => 'date',
            'start_time' => 'datetime',
            'end_time' => 'datetime',
            'max_users' => 'integer',
            'direction' => 'string',
            'latitude' => 'float',
            'longitude' => 'float',
        ];
     }
}
