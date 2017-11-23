<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fixture extends Model
{
    protected $table = 'fixtures';
    protected $fillable = [
        'league_id',
        'home_team',
        'away_team',
        'play_date',
    ];

    public function leagues()
    {
        return $this->belongsTo('App\League', 'league_id');
    }

    public function teams()
    {
        return $this->belongsToMany('App\Fixture', 'teams');
    }
}
