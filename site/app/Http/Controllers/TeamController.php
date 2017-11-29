<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use Illuminate\Support\Facades\Input;
use App\Team;
use App\League;
use App\Player;
use App\Fixture;
use File;
use App\TrackLog;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TrackLog $tracker)
    {
        $teams = Team::with('leagues')->paginate(5);
        // $tracker->track('xxxxx');
        return view('team.index', compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->validate(request(), [
          'name' => 'required|unique:teams',
        //   'description' => 'required',
        ]);
        $team = new Team;
        $team->league_id    = $request->league_id;
        $team->name         = $request->name;
        $team->logo         = '';
        $team->description  = $request->description;
        $team->save();
        if($request->hasFile('image')){
            $imageName = $team->id . '.' . $request->file('image')->getClientOriginalExtension();
        }else{
            $imageName = '';
        }
    
        $path = base_path() . '/public/images/teams/';
        File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);
        if($request->hasFile('image')){
            $request->file('image')->move($path, $imageName);
        }
        $team = Team::find($team->id);
        $team->logo = $imageName;
        $team->save();

        return redirect('team')->with('message', 'Create Success!');
    }

    public function createForm()
    {
        $leagues = League::select('id', 'name')->get();
        return view('team.create', compact('leagues'));
    }

    /**
     * Store a newly created resource in storage.
     *TrackLog
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(TrackLog $tracker, $id)
    {
        $team = team::find($id);
        // $tracker->track('<script>alert("showing")</script>');
        $players = Player::where('team_id', $id)->with('teams')->paginate(5);
        return view('team.show', array(
            'team' => $team,
            'players' => $players,
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $team = Team::where('id', $id)->first();
        $leagues = League::select('id', 'name')->get();

        return view('team.edit', compact('team', 'id', 'leagues'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate(request(), [
            'name' => 'required',
            // 'description' => 'required',
        ]);
        // dd($request);
        $team = Team::find($id);
        $team->name = $request->name;
        $team->league_id = $request->league_id;
        $team->description = $request->description;
        iew()->composer(
            [ 
                'main.league', 
                'fixture.index', 
                'league.index', 
                'league.show', 
                'team.index', 
                'team.show', 
                'team.player', 
                'player.index', 
                'player.show' 
            ],
             'App\Http\ViewComposers\LogComposer'
            );
        if($request->hasFile('image')){
            $imageName = $id . '.' . $request->file('image')->getClientOriginalExtension();
            $path = base_path() . '/public/images/teams/';
            File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);
            $request->file('image')->move($path, $imageName);
            $team->logo = $imageName;
        }

        $team->save();
        return redirect('team')->with('message', 'Team has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $team = Team::find($id);
        $team->delete();
        return redirect('team')->with('message', 'Team deleted successfully');
    }

    public function getPlayer($id)
    {
        $team = Team::find($id);
        $players = Player::where('team_id', $id)->with('teams')->paginate(5);
        return view('team.player', compact('players', 'team'));
    }

    public function ajax()
    {
        $league_id = Input::get('league_id');
        $teams = Team::select('id', 'name')->where('league_id', $league_id)->get();
        return Response::json($teams);
    }

    public function ajaxFixture($id)
    {
        $league_id = $id;
        $homeTeams = Team::where('league_id', $league_id)->get();
        // $homeFirst = Fixture::select('away_team')->where('home_team', $homeTeams->first()->id)->where('league_id', $league_id)->get();
        // $awayTeams = Team::where('league_id', $league_id)->whereNotIn('id', $homeFirst)->where('id', '!=', $homeTeams->first()->id)->get();
        $teams = array(
            'homeTeams' => $homeTeams,
            'awayTeams' => $homeTeams,
        );
        return Response::json($teams);
    }

    public function search()
    {
        $q = Input::get('q');
        if ($q != "") {
            $teams = Team::where('name', 'LIKE', '%' . $q . '%')->orWhere('description', 'LIKE', '%' . $q . '%')->paginate(5)->setPath('');
            $pagination = $teams->appends(array(
                'q' => Input::get('q')
            ));
            if (count($teams) > 0) {
                return view('team.index', compact('teams', 'q'))->withQuery($q);
            }
        }
        return redirect('team')->withMessage('No Details found. Try to search again !');
    }

    public function ajaxChangeHomeTeam()
    {
        $team_id = Input::get('team_id');
        $team = Team::select('league_id')->where('id', $team_id)->get();
        $homeFirst = Fixture::select('away_team')->where('home_team', $team_id)->where('league_id', $team->first()->league_id)->get();
        $awayTeams = Team::where('league_id', $team->first()->league_id)->whereNotIn('id', $homeFirst)->where('id', '!=', $team_id)->get();
        return Response::json($awayTeams);
    }
}
