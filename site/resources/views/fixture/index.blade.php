@extends('layouts.clean')

@section('title', 'Fixture')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-6">
      <a href="fixture/form" class="btn btn-default">Add Fixture</a>
    </div>
  </div>
  <div class="row">
    <div class="col-sm">
    @if(session()->has('message'))
      <div class="alert alert-success">
          {{ session()->get('message') }}
      </div>
    @endif
      <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <th scope="col">Date</th>
            <th scope="col">Home</th>
            <th scope="col">Away</th>
            <th scope="col">League</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
        @foreach($fixtures as $fixture)
          <tr id="tr_{{$fixture->id}}">
            <td>{{ date('d/m/Y H:i:s', strtotime($fixture->play_date)) }}</td>
            {{--  <td>{{ $fixture->play_date }}</td>  --}}
            <td>
            @if (file_exists(public_path('/images/teams/' . $fixture->home_team_logo)))
                  <img src="{{ asset('/images/teams/' . $fixture->home_team_logo ) }}" style="width: 50px; height: 50px;" />
              @else
                  <img src="https://dummyimage.com/50x50/bdbdbd/000000" style="width: 50px; height: 50px;" >
              @endif
            {{ $fixture->home_team_name }}
            </td>
            <td>
            @if (file_exists(public_path('/images/teams/' . $fixture->away_team_logo)))
                  <img src="{{ asset('/images/teams/' . $fixture->away_team_logo ) }}" style="width: 50px; height: 50px;" />
              @else
                  <img src="https://dummyimage.com/50x50/bdbdbd/000000" style="width: 50px; height: 50px;" >
              @endif
            {{ $fixture->away_team_name }}
            </td>
            <td>{{ $fixture->league_name }}</td>
            <td>
                <a class="btn btn-info" href="fixture/edit/{{ $fixture->id }}">Update</a>
                <a class="btn btn-danger" onclick="return confirm('Are you sure?')" href="{{action('FixtureController@destroy', $fixture->id)}}">Delete</a>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      {{ $fixtures->links('vendor.pagination.bootstrap-4') }}
    </div>
  </div>
</div>

@endsection