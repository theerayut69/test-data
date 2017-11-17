<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teams extends Model
{
    
    protected $fillable = [
        'league_id',
        'name',
        'logo',
        'description',
    ];

    public function leagues(){
        return $this->belongsTo('App\Models\Leagues');
    }
}
