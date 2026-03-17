<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'num_partner',    
        'nickname',
        'name',
        'password',
        'type',
        'registration_date',
        'withdrawal_date',
        'email',
        'telephone',
        'age',
        'language'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    //relacion muchos a muchos con la tabla zassession. Mirar video muhos a muchos min 12/13
    public function zassession()
    {
        return $this->belongsToMany(
            Zassessions::class, 
            'user_zassession', 
            'user_id', 
            'zassession_id'
        );
    }

    protected static function booted()
    {
        static::creating(function ($user) {

            if (!$user->num_partner) {
                $user->num_partner = (User::max('num_partner') ?? 0) + 1;
            }
            if (!$user->nickname) {
                $user->nickname = $user->name;
            }
            if (!$user->registration_date) {
                $user->registration_date = now();
            }
            if (!$user->age) {
                $user->age = 18; //the age of the guest is not important. I will change it to the real age, if they became partners
            }
            if (!$user->type) {
                $user->type = 'guest';
            }
        });
    }    
}
