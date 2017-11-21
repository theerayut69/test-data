<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fixture extends Model
{
    protected $fillable = [
        'league_id',
        'home_team',
        'away_team',
    ];

    public function leagues(){
        return $this->belongsTo('App\League');
    }

    public function teams()
    {
        return $this->belongsToMany('App\Team');
    }
}
