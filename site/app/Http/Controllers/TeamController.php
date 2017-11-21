<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Team;
use App\League;
use File;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teams = Team::with('leagues')->get();
        return view('team.index',compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $team = new Team;
        $team->league_id = $request->input('league_id');
        $team->name = $request->input('name');
        $team->logo = '';
        $team->description = $request->input('description');
        $team->save();

        $imageName = $team->id . '.' . $request->file('image')->getClientOriginalExtension();

        $path = base_path() . '/public/images/teams/';
        File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);
        $request->file('image')->move(
            $path, $imageName
        );

        $team = Team::find($team->id);
        $team->logo = $imageName;
        $team->save();

        return redirect('team')->with('message', 'Create Success!');

    }

    public function createForm()
    {
        $leagues = League::select('id','name')->get();
        return view('team.create', compact('leagues'));
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
        //
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
        $leagues = League::select('id','name')->get();

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
        $team = Team::find($id);
        // $this->validate(request(), [
        //   'name' => 'required',
        //   'description' => 'required|numeric'
        // ]);
        $team->name = $request->input('name');
        $team->leage_id = $request->input('league_id');
        $team->description = $request->input('description');
        $team->save();
        return redirect('team')->with('success','Team has been updated');
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
        return redirect('team')->with('message','League deleted successfully');
    }
}
