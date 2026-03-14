<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute as CastsAttribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Boardgames extends Model
{
    //Sino le pasamos el nombre de la tabla, Laravel asume que el nombre de la tabla es el plural del nombre del modelo y en minusculas.
    //En este caso "boardgames". 
    //Si usamos nombre de tablas y de clases con la convencion de Laravel (ingles, tabla plural yu minusculas, modelo singular y primera mayuscula), no es necesario especificar el nombre de la tabla en el modelo, ya que Laravel lo infiere automáticamente.
    //Pero en caso contrario, es recomendable indicar el nombre de la tabla para evitar errores y confusiones.
    //Si queremos especificar un nombre de tabla diferente, podemos usar la propiedad $table.
    protected $table = 'boardgames';

    use HasFactory;

    //sirve para la asignación masiva. Los campos que se pueden asignar masivamente son los que se encuentran en el array $fillable. Si un campo no se encuentra en el array $fillable, no se podrá asignar masivamente y se deberá asignar de forma individual.
    protected $fillable = ['name', 'slug', 'min_players', 'max_players', 'min_age', 'duration', 'description'];
    
    //Los campos que no se pueden asignar masivamente son los que se encuentran en el array $guarded. Si un campo se encuentra en el array $guarded, no se podrá asignar masivamente y se deberá asignar de forma individual. En este caso, el campo "id" no se puede asignar masivamente, ya que es un campo autoincremental y se genera automáticamente al crear un nuevo registro.
    //protected $guarded = ['id']; 

    protected function name(): CastsAttribute
    {
        /*
        return new Attribute(
            get: fn ($value) => ucwords($value), //Convierte el valor a mayúscula cada palabra al obtenerlo
            set: fn ($value) => strtolower($value) //Convierte el valor a minúscula al establecerlo
        );
        */
        return CastsAttribute::make(
            get: fn ($value) => ucwords($value), //Convierte el valor a mayúscula cada palabra al obtenerlo
            set: fn ($value) => strtolower($value) //Convierte el valor a minúscula al establecerlo
        );
    }
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($boardgame) {
            $boardgame->slug = Str::slug($boardgame->name);
        });
    }

    //Por defecto, Laravel asume que totos los campos son de tipo string, pero si queremos especificar el tipo de dato de cada campo, 
    //podemos usar la propiedad $casts o el método casts().
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

    //relacion muchos a muchos con la tabla types. Mirar video muhos a muchos min 12/13
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
