@extends('layouts.aspire')

@section('title', 'Team {{ $team->name }}')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
        <div class="card">
            <h4 class="card-header">Team</h4>
            <div class="card-body">
                <h4 class="card-title">{{ $team->name }}</h4>
                <p class="card-text">{{ $team->description }}</p>
            </div>
        </div>
        <br/>

        <div class="card">
            <h4 class="card-header">Player</h4>
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">Player Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Team</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($players as $player)
                    <tr id="tr_{{$player->id}}">
                        <td>{{ $player->name }}</td>
                        <td>{{ $player->description }}</td>
                        <td>{{ $player->teams->name }}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
      {{ $players->links('vendor.pagination.bootstrap-4') }}
    </div>
  </div>
</div>

@endsection