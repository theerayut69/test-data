@extends('layouts.clean')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">

            <div class="card-block">
                <h4 class="card-title"><i class="ti-basketball"></i> Basketball</h4>
                <div class="pill-info nav-vertical nav-stacked">
                    <ul class="nav nav-pills" role="tablist">
                        @if($leagues)
                            @foreach($leagues AS $league)
                                <li class="nav-item">
                                    <a href="#pills-vertical-league{{$league->id}}" class="nav-link @if($loop->first){{ 'active' }} @endif" role="tab" data-toggle="tab" aria-expanded="false">{{ $league->name }}</a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                    <div class="tab-content">
                        @if($leagues)
                            @foreach($leagues AS $league)
                                <div role="tabpanel" class="tab-pane fade in @if($loop->first){{ 'active' }}@endif" id="pills-vertical-league{{ $league->id }}" aria-expanded="false">
                                    <div class="card">
                                        <h4 class="card-header">{{ $league->name }} Fixtures</h4>
                                        <div class="card-body">
                                            <table class="table table-striped table-bordered table-responsive-sm">
                                                <thead>
                                                <tr>
                                                    <th width="20%" scope="col" class="text-center">Date</th>
                                                    <th width="40%" scope="col" class="text-center">Home</th>
                                                    <th width="40%" scope="col" class="text-center">Away</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($fixtures[$league->id] as $fixture)
                                                <tr id="tr_{{$fixture->id}}">
                                                    <td>{{ date('d/m/Y H:i:s', strtotime($fixture->play_date)) }}</td>
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
                                                </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <h4 class="card-header">{{ $league->name }} Teams</h4>
                                        <div class="card-body">
                                            <table class="table table-striped table-bordered table-responsive-sm">
                                                <thead>
                                                <tr>
                                                    <th width="10%" scope="col" class="text-center">Logo</th>
                                                    <th width="20%" scope="col" class="text-center">Team Name</th>
                                                    <th width="70%" scope="col" class="text-center">Description</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($teams[$league->id] as $team)
                                                <tr id="tr_{{$team->id}}">
                                                    <td class="text-center">
                                                    @if (file_exists(public_path('/images/teams/' . $team->logo)))
                                                        <img src="{{ asset('/images/teams/' . $team->logo ) }}" style="width: 50px; height: 50px;" />
                                                    @else
                                                        <img src="https://dummyimage.com/50x50/bdbdbd/000000" style="width: 50px; height: 50px;" >
                                                    @endif
                                                    </td>
                                                    <td><a href="team/{{ $team->id }}/player">{{ $team->name }}</a></td>
                                                    <td>{{ $team->description }}</td>
                                                </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
