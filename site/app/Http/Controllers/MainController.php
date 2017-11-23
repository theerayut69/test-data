<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\League;
use App\Team;
use App\Fixture;
use DB;

class MainController extends Controller
{
    public function getLeagueDefault()
    {
        $leagues = League::all();
        $teams = Team::with('leagues')->get();
        $fixtures = DB::select('SELECT f.*, t_home.name AS home_team_name, t_away.name AS away_team_name, l.name AS league_name from fixtures AS f LEFT JOIN teams AS t_home ON f.home_team = t_home.id LEFT JOIN teams AS t_away ON f.away_team = t_away.id LEFT JOIN leagues AS l ON f.league_id = l.id');
        foreach ($leagues as $league) {
            $teams[$league->id] = collect($teams)->where('league_id', $league->id);
            $fixtures[$league->id] = collect($fixtures)->where('league_id', $league->id);
        }

        return view('main.league', compact('leagues', 'teams', 'fixtures', 'id'));
    }
}
