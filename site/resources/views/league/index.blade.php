@extends('layouts.aspire')

@section('title', 'Leagues')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-sm">
    @if(session()->has('message'))
      <div class="alert alert-success">
          {{ session()->get('message') }}
      </div>
    @endif
    <a href="{{ route('league-form') }}" class="btn btn-primary">Add League</a>
      <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <th scope="col">League Name</th>
            <th scope="col">Description</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
        @foreach($leagues as $league)
          <tr id="tr_{{$league->id}}">
            <td>{{ $league->name }}</td>
            <td>{{ $league->description }}</td>
            <td>
                <a class="btn btn-info" href="{{ route('league-edit', $league->id) }}">Update</a>
                <a class="btn btn-danger" onclick="return confirm('Are you sure?')" href="{{route('league-delete', $league->id)}}">Delete</a>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection