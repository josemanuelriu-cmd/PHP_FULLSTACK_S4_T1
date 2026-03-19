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
            get: fn ($value) => ucwords($value), 
            set: fn ($value) => strtolower($value) 
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

    public function users()
    {
        return $this->belongsToMany(
            User::class, 
            'user_zassession',             
            'zassession_id',
            'user_id', 
        );
    }

    public function games()
    {
        return $this->hasMany(Games::class, 'zassession_id');
    }
}
