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
        // $Fixture = DB::select('SELECT f.*, t_home.name AS home_team_name, t_away.name AS away_team_name, l.name AS league_name from fixtures AS f LEFT JOIN teams AS t_home ON f.home_team = t_home.id LEFT JOIN teams AS t_away ON f.away_team = t_away.id LEFT JOIN leagues AS l ON f.league_id = l.id');
        $aFixtures = DB::table('fixtures')
        ->join('teams as teams_home', 'fixtures.home_team', '=', 'teams_home.id')
        ->join('teams as teams_away', 'fixtures.away_team', '=', 'teams_away.id')
        ->join('leagues', 'fixtures.league_id', '=', 'leagues.id')
        ->select('fixtures.*', 'teams_home.name AS home_team_name', 'teams_home.logo AS home_team_logo', 'teams_away.name AS away_team_name', 'teams_away.logo AS away_team_logo', 'leagues.name AS league_name')        
        ->get();
        foreach ($leagues as $league) {
            $teams[$league->id] = collect($teams)->where('league_id', $league->id);
            $fixtures[$league->id] = collect($aFixtures)->where('league_id', $league->id);
        }
        // dd($fixtures);

        return view('main.league', compact('leagues', 'teams', 'fixtures', 'id'));
    }
}
