<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Games extends Model
{
    protected $fillable = [
        'zassession_id',
        'boardgame_id',
        'host_user_id',
        'max_players',
        'start_time',
        'status',
        'necesary_know_how'
    ];

    public function session()
    {
        return $this->belongsTo(Zassessions::class);
    }

    public function boardgame()
    {
        return $this->belongsTo(Boardgames::class);
    }

    public function players()
    {
        return $this->belongsToMany(User::class, 'game_user', 'game_id' , 'user_id');
    }

    public function host()
    {
        return $this->belongsTo(User::class,'host_user_id');
    }
}
