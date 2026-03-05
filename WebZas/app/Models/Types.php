<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute as CastsAttribute;
use Illuminate\Database\Eloquent\Model;

class Types extends Model
{
    protected $table = 'types';

    protected $fillable = ['type'];

    protected function name(): CastsAttribute
    {
        return CastsAttribute::make(
            get: fn ($value) => ucwords($value), //Convierte el valor a mayúscula cada palabra al obtenerlo
            set: fn ($value) => strtolower($value) //Convierte el valor a minúscula al establecerlo
        );
    }

    protected function casts(): array{
        return [
            'type' => 'string'            
        ];
    }

    //relacion muchos a muchos con la tabla boardgames. Mirar video muhos a muchos min 12/13
    public function boardgames()
    {
        return $this->belongsToMany(
            Boardgames::class, 
            'boardgame_type', 
            'boardgame_id', 
            'type_id'
        )->withTimestamps();
    }
}
