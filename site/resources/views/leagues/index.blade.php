@extends('layouts.app')

@section('title', 'Leagues')

@section('content')
<div class="container">
  <div class="row" style="margin-top: 100px;">
    <div class="col-sm">
    <a href="{{ route('league-form') }}">test</a>
      <table class="table table-dark">
        <thead>
          <tr>
            <!-- <th scope="col">#</th> -->
            <th scope="col">First Name</th>
            <th scope="col">Description</th>
            <!-- <th scope="col">Username</th> -->
          </tr>
        </thead>
        <tbody>
        @foreach($leagues as $league)
          <tr>
            <td>{{ $league->name }}</td>
            <td>{{ $league->description }}</td>
            <td>
            {{ Form::open(array('url' => 'leagues/' . $value->id, 'class' => 'pull-right')) }}
              {{ Form::hidden('_method', 'DELETE') }}
              {{ Form::submit('Delete this League', array('class' => 'btn btn-warning')) }}
            {{ Form::close() }}
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection