@extends('layouts.aspire')

@section('title', 'Fixture')

@section('content')
<div class="container">
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
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
        @foreach($fixtures as $fixture)
          <tr id="tr_{{$fixture->id}}">
            <td>{{ date('d/m/Y H:i:s', $fixture->play_date) }}</td>
            <td>{{ $fixture->home_team }}</td>
            <td>{{ $fixture->away_team }}</td>
            <td>
                <a class="btn btn-info" href="team/edit/{{ $fixture->id }}">Update</a>
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
      {{--  {{ $fixtures->links('vendor.pagination.bootstrap-4') }}  --}}
    </div>
  </div>
</div>

@endsection