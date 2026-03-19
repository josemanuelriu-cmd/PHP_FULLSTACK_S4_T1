<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute as CastsAttribute;
use Illuminate\Database\Eloquent\Model;

class Types extends Model
{
    protected $table = 'types';

    protected $fillable = ['type', 'description'];

    protected function name(): CastsAttribute
    {
        return CastsAttribute::make(
            get: fn ($value) => ucwords($value), 
            set: fn ($value) => strtolower($value)
        );
    }

    protected function casts(): array{
        return [
            'type' => 'string'            
        ];
    }

    public function boardgames()
    {
        return $this->belongsToMany(
            Boardgames::class, 
            'boardgame_type', 
            'type_id',
            'boardgame_id'            
        )->withTimestamps();
    }
}
