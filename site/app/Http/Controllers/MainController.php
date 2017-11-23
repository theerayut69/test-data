<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\League;
use App\Team;
use App\Fixture;
use DB;

class MainController extends Controller
{
    public function get_league_default(){
        $leagues = League::all();
        $teams = Team::with('leagues')->get();
        $fixtures = DB::select('SELECT f.*, t_home.name AS home_team_name, t_away.name AS away_team_name, l.name AS league_name from fixtures AS f LEFT JOIN teams AS t_home ON f.home_team = t_home.id LEFT JOIN teams AS t_away ON f.away_team = t_away.id LEFT JOIN leagues AS l ON f.league_id = l.id');
        foreach($leagues AS $league){
            $t[$league->id] = collect($teams)->where('league_id', '=', $league->id);
            $f[$league->id] = collect($fixtures)->where('league_id', '=', $league->id);
        }

        return view('main.league', compact('leagues', 't', 'f', 'id'));
    }

    public function get_league_backup(){
        $leagues = League::all();
        $id = $leagues->first()->id;
        $teams = Team::where('league_id', '=', $id)->get();
        $fixtures = Fixture::where('league_id', '=', $id)->get();
        return $teams;
        return view('main.league', compact('leagues', 'teams', 'id'));
    }

    public function get_league($id){
        $leagues = League::all();
        $teams = Team::where('league_id', '=', $id)->get();
        $fixtures = Fixture::where('league_id', '=', $id)->get();
        // return $fixtures;
        return view('main.league', compact('leagues', 'teams', 'id'));
    }

    public function get_team($id){
        $teams = Team::where('league_id', '=', $id)->get();
        return view('main.team', compact('teams'));
    }

    public function get_player($id){
        $players = Player::where('team_id', '=', $id)->get();
        return view('main.player', compact('players'));
    }

    public function get_fixture($id){
        $fixtures = Fixture::where('league_id', '=', $id)->get();
    }
}
