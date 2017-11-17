<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fixtures extends Model
{
    protected $fillable = [
        'league_id',
        'home_team',
        'away_team',
    ];

    public function leagues(){
        return $this->belongsTo('App\Models\Leagues');
    }
}
