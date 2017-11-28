<?php
namespace App\Observers;

use Auth;
use App\TeamLog;
use App\Team;

class TeamActionsObserver
{
    public function created(Team $team)
    {
        $action = 'created';
        if (Auth::check()) {
            TeamLog::create([
                'user_id'      => Auth::user()->id,
                'action'       => $action,
                'action_model' => $team->getTable(),
                'action_id'    => $team->id
            ]);
        }else{
            TeamLog::create([
                'user_id'      => 1,
                'action'       => $action,
                'action_model' => $team->getTable(),
                'action_id'    => $team->id
            ]);
        }
    }

    public function updated(Team $team)
    {
        $action = 'updated';
        if (Auth::check()) {
            TeamLog::create([
                'user_id'      => Auth::user()->id,
                'action'       => $action,
                'action_model' => $team->getTable(),
                'action_id'    => $team->id
            ]);
        }else{
            TeamLog::create([
                'user_id'      => 1,
                'action'       => $action,
                'action_model' => $team->getTable(),
                'action_id'    => $team->id
            ]);
        }
    }

    public function deleting(Team $team)
    {
        if (Auth::check()) {
            TeamLog::create([
                'user_id'      => Auth::user()->id,
                'action'       => 'deleted',
                'action_model' => $team->getTable(),
                'action_id'    => $team->id
            ]);
        }else{
            TeamLog::create([
                'user_id'      => 1,
                'action'       => 'deleted',
                'action_model' => $team->getTable(),
                'action_id'    => $team->id
            ]);
        }
    }
}