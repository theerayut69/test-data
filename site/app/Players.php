<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Players extends Model
{
    protected $fillable = [
        'team_id',
        'name',
        'description',
    ];

    public function teams(){
        return $this->belongsTo('App\Models\Teams');
    }
}
