<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fixture;
use App\League;
use App\Team;
use DB;

class FixtureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // $fixtures = Fixture::all();
        // return $fixtures;
        // $fixtures = Fixture::with('teams')->get();
        // $leagues = League::select('id', 'name')->get();
        // $teams = Team::select('id', 'name')->get();
        $fixtures = DB::select('SELECT f.*, t_home.name AS home_team_name, t_away.name AS away_team_name, l.name AS league_name from fixtures AS f LEFT JOIN teams AS t_home ON f.home_team = t_home.id LEFT JOIN teams AS t_away ON f.away_team = t_away.id LEFT JOIN leagues AS l ON f.league_id = l.id');
        return view('fixture.index',compact('fixtures'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        $this->validate(request(), [
            // 'play_time' => 'required',
            // 'team_id' => 'required',
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
        $teams = Team::where('league_id', '=', $leagues->first()->id)->get();
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
        // return strtotime($fixture->play_date);
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
        return redirect('fixture')->with('message','Fixture has been updated');
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
        return redirect('fixture')->with('message','Fixture deleted successfully');
    }

}
