<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\League;
use App\Team;

class TeamComposer
{
    public $leagueList = [];
    public $teamList = [];

    /**
     * Create a movie composer.
     *
     * @return void
     */
    public function __construct()
    {
        $this->leagueList = League::all();
        $this->teamList = Team::all();
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('menuTeams', $this->teamList)->with('menuLeagues', $this->leagueList);
    }
}