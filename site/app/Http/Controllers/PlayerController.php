<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Player;
use App\League;
use App\Team;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $players = Player::with('teams')->get();
        return view('player.index', compact('players'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        $this->validate(request(), [
            'name' => 'required',
            // 'team_id' => 'required',yerController.php

        ]);
        $player = new Player;
        $player->team_id = $request->team_id;
        $player->name = $request->name;
        $player->description = $request->description;
        $player->save();

        return redirect('player')->with('message', 'Create Success!');
    }

    public function createForm()
    {
        $leagues = League::select('id', 'name')->get();
        $teams = Team::where('league_id', '=', $leagues->first()->id)->get();
        return view('player.create', compact('teams', 'leagues'));
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
        $player = Player::find($id);
        // dd($player);
        return view('player.show', array(
            'player' => $player,
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $player = Player::find($id);
        $player_league = Team::find($player->team_id);
        $teams = Team::select('id', 'name')->where('league_id', $player_league->league_id)->get();
        $leagues = League::select('id', 'name')->get();
        return view('player.edit', compact('player', 'teams', 'leagues', 'player_league'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $player = Player::find($id);
        $player->name = $request->name;
        $player->team_id = $request->team_id;
        $player->description = $request->description;
        $player->save();
        return redirect('player')->with('message', 'Player has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $player = Player::find($id);
        $player->delete();
        return redirect('team')->with('message', 'Player deleted successfully');
    }
}
