<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute as CastsAttribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Boardgames extends Model
{
    protected $table = 'boardgames';

    use HasFactory;

    protected $fillable = ['name', 'slug', 'min_players', 'max_players', 'min_age', 'duration', 'description'];
    
    protected function name(): CastsAttribute
    {
        return CastsAttribute::make(
            get: fn ($value) => ucwords($value), 
            set: fn ($value) => strtolower($value) 
        );
    }
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($boardgame) {
            $boardgame->slug = Str::slug($boardgame->name);
        });
    }

    protected function casts(): array{
        return [
            'name' => 'string',
            'min_players' => 'integer',
            'max_players' => 'integer',
            'min_age' => 'integer',
            'duration' => 'integer',
            'description' => 'string'
        ];
    }
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function types()
    {
        return $this->belongsToMany(
            Types::class, 
            'boardgame_type', 
            'boardgame_id', 
            'type_id'
        )->withTimestamps();
    }

    public function scopeOfType($query, $typeId)
    {
        if ($typeId) {
            $query->whereHas('types', function($q) use ($typeId) {
                $q->where('types.id', $typeId);
            });
        }
    }

    public function scopeSearchName($query, $name)
    {
        if ($name) {
            $query->where('name', 'like', "%{$name}%");
        }
    }

    public function scopePlayers($query, $players)
    {
        if ($players) {
            $query->where('min_players', '<=', $players)
                  ->where('max_players', '>=', $players);
        }
    }

    public function scopeAge($query, $age)
    {
        if ($age) {
            $query->where('min_age', '<=', $age);
        }
    }
    public function scopeDuration($query, $duration)
    {
        if ($duration) {
            $query->where('duration', '<=', $duration);
        }
    }
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_user_id');
    }    
}
