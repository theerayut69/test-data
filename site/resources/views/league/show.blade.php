@extends('layouts.aspire')

@section('title', 'Leagues')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
        <div class="card">
            <h4 class="card-header">League</h4>
            <div class="card-body">
                <h4 class="card-title">{{ $league->name }}</h4>
                <p class="card-text">{{ $league->description }}</p>
            </div>
        </div>
        <br/>

        <div class="card">
            <h4 class="card-header">Teams</h4>
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">Logo</th>
                        <th scope="col">Team Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">League</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($teams as $team)
                    <tr id="tr_{{$team->id}}">
                        <td>
                        @if (file_exists(public_path('/images/teams/' . $team->logo)))
                        <img src="{{ asset('/images/teams/' . $team->logo ) }}" class="" style="width: 50px; height: 50px;" />
                        @else
                            <img src="https://dummyimage.com/50x50/bdbdbd/000000" style="width: 50px; height: 50px;" >
                        @endif
                        </td>
                        <td>{{ $team->name }}</td>
                        <td>{{ $team->description }}</td>
                        <td>{{ $team->leagues->name }}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
      {{ $teams->links('vendor.pagination.bootstrap-4') }}
    </div>
  </div>
</div>

@endsection