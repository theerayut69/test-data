@extends('layouts.aspire')

@section('title', 'Teams')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-sm">
    @if(session()->has('message'))
      <div class="alert alert-success">
          {{ session()->get('message') }}
      </div>
    @endif
    <a href="team/form" class="btn btn-primary">Add Team</a>
      <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <th scope="col">Logo</th>
            <th scope="col">Team Name</th>
            <th scope="col">Description</th>
            <th scope="col">League</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
        @foreach($teams as $team)
          <tr id="tr_{{$team->id}}">
            <td>
            @if (file_exists(public_path('/images/teams/' . $team->logo)))
              <img src="{{ asset('/images/teams/' . $team->logo ) }}" style="width: 50px; height: 50px;" />
            @else
                <img src="https://dummyimage.com/50x50/bdbdbd/000000" style="width: 50px; height: 50px;" >
            @endif
            </td>
            <td>{{ $team->name }}</td>
            <td>{{ $team->description }}</td>
            <td>{{ $team->league_id }}</td>
            <td>
                <a class="btn btn-info" href="team/edit/{{ $team->id }}">Update</a>
                <a class="btn btn-danger" onclick="return confirm('Are you sure?')" href="{{action('TeamController@destroy', $team->id)}}">Delete</a>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection