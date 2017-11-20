<?php

namespace App\Http\Controllers;

use App\Leagues;
use Illuminate\Http\Request;
use App\Http\Requests;
use DB;

class LeaguesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $leagues = Leagues::all();
        return view('leagues.index',['leagues' => $leagues]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $name = $request->input('name');
        $description = $request->input('description');
        Leagues::create([
            'name' => $name,
            'description' => $description,
        ]);

        return redirect('leagues')->with('message', 'Create Success!');

        // $leagues = Leagues::all();
        // return view('leagues.index',['leagues' => $leagues]);

    }


    public function createForm()
    {
        return view('leagues.create');
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
        //
        // echo $id; exit;
        $league = Leagues::where('id', $id)->first();

        // echo "<pre>"; print_r($league);exit;

        return view('leagues.edit', compact('league', 'id'));
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
        //
        // echo "555"; exit;
        $leagues = Leagues::find($id);
        // $this->validate(request(), [
        //   'name' => 'required',
        //   'description' => 'required|numeric'
        // ]);
        $leagues->name = $request->input('name');
        $leagues->description = $request->input('description');
        $leagues->save();
        return redirect('leagues')->with('success','League has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $league = Leagues::find($id);
        $league->delete();
        return redirect('leagues')->with('message','League deleted successfully');
    }
}
