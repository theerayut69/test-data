@extends('layouts.aspire')

@section('title', 'Team {{ $player->name }}')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
        <div class="card">
            <h4 class="card-header">Player</h4>
            <div class="card-body">
                <h4 class="card-title">Name : {{ $player->name }}</h4>
                <p class="card-text">Description: {{ $player->description }}</p>
                {{--  <p class="card-text">Team: {{ $player->teams->name }}</p>  --}}
            </div>
        </div>
    </div>
  </div>
</div>

@endsection