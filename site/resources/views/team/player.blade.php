@extends('layouts.aspire')

@section('title', 'Teams')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Players</li>
                </ol>
            </nav>
        </div>
    </div>
  <div class="row">
    <div class="col-sm">
    @if(session()->has('message'))
      <div class="alert alert-success">
          {{ session()->get('message') }}
      </div>
    @endif
    <h3>{{ $team->name }} Players</h3>
      <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <th scope="col">Player Name</th>
            <th scope="col">Description</th>
            <th scope="col">Team</th>
          </tr>
        </thead>
        <tbody>
        @if($players->count())
            @foreach($players as $player)
            <tr id="tr_{{$player->id}}">
                <td>{{ $player->name }}</td>
                <td>{{ $player->description }}</td>
                <td>{{ $player->teams->name }}</td>
            </tr>
            @endforeach
        @else
            <tr>
                <td colspan="3" class="text-danger text-center">Data not found.</td>
            </tr>
        @endif
        </tbody>
      </table>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      {{ $players->links('vendor.pagination.bootstrap-4') }}
    </div>
  </div>
</div>

@endsection