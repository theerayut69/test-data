<?php

namespace App\Http\Controllers;

use App\League;
use App\Team;
use Illuminate\Http\Request;

class LeagueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $leagues = League::all();
        return view('league.index', ['leagues' => $leagues]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->validate(request(), [
            'name' => 'required|unique:leagues',
        //   'description' => 'required',
        ]);
        $leagues = new League;
        $leagues->name = $request->name;
        $leagues->description = $request->description;
        $leagues->save();

        return redirect('league')->with('message', 'Create Success!');
    }


    public function createForm()
    {
        return view('league.create');
    }

    /**
     * Store a newly created resource in storage.
     *
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
    public function show($id)
    {
        $league = League::find($id);
        $teams = Team::where('league_id', $id)->with('leagues')->paginate(5);
        // dd($league);
        return view('league.show', array(
            'league' => $league,
            'teams' => $teams,
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
        //
        // echo $id; exit;
        $league = League::where('id', $id)->first();

        // echo "<pre>"; print_r($league);exit;

        return view('league.edit', compact('league', 'id'));
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
        //   'description' => 'required',
        ]);
        $leagues = League::find($id);
        $leagues->name = $request->name;
        $leagues->description = $request->description;
        $leagues->save();
        return redirect('league')->with('message', 'League has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $league = League::find($id);
        $league->delete();
        return redirect('league')->with('message', 'League deleted successfully');
    }
}
