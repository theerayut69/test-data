<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    
    protected $fillable = [
        'league_id',
        'name',
        'logo',
        'description',
    ];

    public function leagues()
    {
        return $this->belongsTo('App\League', 'league_id');
    }

    public function fixtures()
    {
        return $this->belongsToMany('App\Fixture');
    }

    public function players()
    {
        return $this->hasMany('App\Player');
    }
}
