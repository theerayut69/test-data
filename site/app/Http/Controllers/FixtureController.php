<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fixture;
use App\League;
use App\Team;
use DB;
// use App\Http\Validation\ValidTeam;

class FixtureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $fixtures = DB::table('fixtures')
        ->join('teams as teams_home', 'fixtures.home_team', '=', 'teams_home.id')
        ->join('teams as teams_away', 'fixtures.away_team', '=', 'teams_away.id')
        ->join('leagues', 'fixtures.league_id', '=', 'leagues.id')
        ->select('fixtures.*', 'teams_home.name AS home_team_name', 'teams_home.logo AS home_team_logo', 'teams_away.name AS away_team_name', 'teams_away.logo AS away_team_logo', 'leagues.name AS league_name')        
        ->paginate(5);
        return view('fixture.index', compact('fixtures'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        $this->validate(request(), [
            // 'home_team' => [
            //     new ValidTeam(new \GuzzleHttp\Client),
            // ]
        ]);
        $fixture = new Fixture;
        $fixture->league_id = $request->league_id;
        $fixture->home_team = $request->home_team;
        $fixture->away_team = $request->away_team;
        $fixture->play_date = date('Y-m-d H:i:s', strtotime($request->play_date));
        $fixture->save();
        return redirect('fixture')->with('message', 'Create Success!');
    }

    public function createForm()
    {
        $leagues = League::select('id', 'name')->get();
        $teams = Team::where('league_id', $leagues->first()->id)->get();
        // $homeFirst = Fixture::select('away_team')->where('home_team', $homeTeams->first()->id)->where('league_id', $leagues->first()->id)->get();
        // $awayTeams = Team::where('league_id', $leagues->first()->id)->whereNotIn('id', $homeFirst)->where('id', '!=', $homeTeams->first()->id)->get();
        return view('fixture.create', compact('teams', 'leagues'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $fixture = Fixture::find($id);
        $leagues = League::select('id', 'name')->get();
        $teams = Team::select('id', 'name')->where('league_id', '=', $fixture->league_id)->get();
        return view('fixture.edit', compact('fixture', 'leagues', 'teams'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $fixture = Fixture::find($id);
        $fixture->league_id = $request->league_id;
        $fixture->home_team = $request->home_team;
        $fixture->away_team = $request->away_team;
        $fixture->play_date = date('Y-m-d H:i:s', strtotime($request->play_date));
        $fixture->save();
        return redirect('fixture')->with('message', 'Fixture has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $player = Fixture::find($id);
        $player->delete();
        return redirect('fixture')->with('message', 'Fixture deleted successfully');
    }
}
