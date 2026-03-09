<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute as CastsAttribute;

class Zassessions extends Model
{
    protected $table = 'zassessions';

    protected $fillable = ['date', 'name', 'event_name', 'start_time', 'end_time', 'max_users', 'direction', 'latitude', 'longitude'];

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
            'name' => 'string',
            'event_name' => 'string',
            'start_time' => 'datetime',
            'end_time' => 'datetime',
            'max_users' => 'integer',
            'direction' => 'string',
            'latitude' => 'float',
            'longitude' => 'float',
        ];
     }

    //relacion muchos a muchos con la tabla users. Mirar video muhos a muchos min 12/13
    public function users()
    {
        return $this->belongsToMany(
            User::class, 
            'user_zassession',             
            'zassession_id',
            'user_id', 
        );
    }
}
