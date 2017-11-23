@extends('layouts.aspire')

@section('title', 'Teams')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-sm">
    @if(session()->has('message'))
      <div class="alert alert-success">
          {{ session()->get('message') }}
      </div>
    @endif
    <a href="player/form" class="btn btn-default">Add Player</a>
      <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <th scope="col">Player Name</th>
            <th scope="col">Description</th>
            <th scope="col">Team</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
        @foreach($players as $player)
          <tr id="tr_{{$player->id}}">
            <td>{{ $player->name }}</td>
            <td>{{ $player->description }}</td>
            <td>{{ $player->teams->name }}</td>
            <td>
                <a class="btn btn-info" href="player/edit/{{ $player->id }}">Update</a>
                <a class="btn btn-danger" onclick="return confirm('Are you sure?')" href="{{action('PlayerController@destroy', $player->id)}}">Delete</a>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection