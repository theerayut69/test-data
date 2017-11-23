@extends('layouts.aspire')

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
                                                    <th scope="col">Date</th>
                                                    <th scope="col">Home</th>
                                                    <th scope="col">Away</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($f[$league->id] as $value)
                                                <tr id="tr_{{$value->id}}">
                                                    <td>{{ date('d/m/Y H:i:s', strtotime($value->play_date)) }}</td>
                                                    <td>{{ $value->home_team_name }}</td>
                                                    <td>{{ $value->away_team_name }}</td>
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
                                                    <th scope="col">Logo</th>
                                                    <th scope="col">Team Name</th>
                                                    <th scope="col">Description</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($t[$league->id] as $value)
                                                <tr id="tr_{{$value->id}}">
                                                    <td>
                                                    @if (file_exists(public_path('/images/teams/' . $value->logo)))
                                                        <img src="{{ asset('/images/teams/' . $value->logo ) }}" style="width: 50px; height: 50px;" />
                                                    @else
                                                        <img src="https://dummyimage.com/50x50/bdbdbd/000000" style="width: 50px; height: 50px;" >
                                                    @endif
                                                    </td>
                                                    <td>{{ $value->name }}</td>
                                                    <td>{{ $value->description }}</td>
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

            {{--  <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                @if($leagues)
                    @foreach($leagues AS $league)
                        <a class="nav-link @if($loop->first){{ 'active' }} @endif" id="v-pills-league{{ $league->id }}-tab" data-toggle="pill" href="#v-pills-league{{ $league->id }}" role="tab" aria-controls="v-pills-league{{ $league->id }}" aria-selected="true">{{ $league->name }}</a>
                    @endforeach
                @endif
            </div>
            <div class="tab-content" id="v-pills-tabContent">
                @if($leagues)
                    @foreach($leagues AS $league)
                        <div class="tab-pane fade @if($loop->first){{ 'show active' }}@endif" id="v-pills-league{{ $league->id }}" role="tabpanel" aria-labelledby="v-pills-league{{ $league->id }}-tab">{{ $league->name }}</div>
                    @endforeach
                @endif
            </div>  --}}

            {{--  <nav class="nav nav-tabs" id="myTab" role="tablist">
                @if($leagues)
                    @foreach($leagues AS $league)
                        <a class="nav-item nav-link @if($loop->first){{ 'active' }} @endif" id="nav-league{{ $league->id }}-tab" data-toggle="tab" href="#nav-league{{ $league->id }}" role="tab" aria-controls="nav-league{{ $league->id }}" aria-selected="true">{{ $league->name }}</a>
                    @endforeach
                @endif
            </nav>
            <div class="tab-content" id="nav-tabContent">
                @if($leagues)
                    @foreach($leagues AS $league)
                        <div class="tab-pane fade @if($loop->first){{ 'show active' }}@endif" id="nav-league{{ $league->id }}" role="tabpanel" aria-labelledby="nav-league{{ $league->id }}-tab">
                            <br/>
                            <div class="card">
                                <h4 class="card-header">Fixtures</h4>
                                <div class="card-body">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th scope="col">Date</th>
                                            <th scope="col">Home</th>
                                            <th scope="col">Away</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($f[$league->id] as $value)
                                        <tr id="tr_{{$value->id}}">
                                            <td>{{ date('d/m/Y H:i:s', strtotime($value->play_date)) }}</td>
                                            <td>{{ $value->home_team_name }}</td>
                                            <td>{{ $value->away_team_name }}</td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="card">
                                <h4 class="card-header">Teams</h4>
                                <div class="card-body">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th scope="col">Logo</th>
                                            <th scope="col">Team Name</th>
                                            <th scope="col">Description</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($t[$league->id] as $value)
                                        <tr id="tr_{{$value->id}}">
                                            <td>
                                            @if (file_exists(public_path('/images/teams/' . $value->logo)))
                                                <img src="{{ asset('/images/teams/' . $value->logo ) }}" style="width: 50px; height: 50px;" />
                                            @else
                                                <img src="https://dummyimage.com/50x50/bdbdbd/000000" style="width: 50px; height: 50px;" >
                                            @endif
                                            </td>
                                            <td>{{ $value->name }}</td>
                                            <td>{{ $value->description }}</td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>  --}}

        </div>
    </div>
</div>
@endsection
