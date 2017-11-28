<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeamLog extends Model
{
    protected $fillable = ['user_id', 'action', 'action_model', 'action_id'];

    protected $table = 'team_log';
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }  
}
