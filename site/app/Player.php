<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $fillable = [
        'team_id',
        'name',
        'description',
    ];

    public function teams()
    {
        return $this->belongsTo('App\Team', 'team_id');
    }
}
