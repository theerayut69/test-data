@extends('layouts.aspire')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-heading border bottom">
                    <h4 class="card-title">Fixture</h4>
                </div>
                <div class="card-block">
                    <div class="card-block">
                        <div class="row">
                            <div class="col-md-8 ml-auto mr-auto">
                                <form action="create" method="post" role="form" id="form-fixture" novalidate="novalidate" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>League</label>
                                                <select class="form-control" id="fixture_league_id" name="league_id">
                                                    @if($leagues)
                                                        @foreach($leagues as $league)
                                                            <option value="{{ $league->id }}">{{ $league->name }}</option>
                                                        @endforeach
                                                    @else
                                                        <option value="">null</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Home</label>
                                                <select class="form-control" id="home_team" name="home_team">
                                                    @if($teams)
                                                        @foreach($teams as $team)
                                                            <option value="{{ $team->id }}">{{ $team->name }}</option>
                                                        @endforeach
                                                    @else
                                                        <option value="">null</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Away</label>
                                                <select class="form-control" id="away_team" name="away_team">
                                                    @if($teams)
                                                        @foreach($teams as $team)
                                                            <option value="{{ $team->id }}">{{ $team->name }}</option>
                                                        @endforeach
                                                    @else
                                                        <option value="">null</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class='input-group date' id='datetimepicker1'>
                                                    <input type='text' name="play_date" class="form-control" />
                                                    <span class="input-group-addon">
                                                        <span class="ti-calendar"></span>
                                                    </span>
                                                </div>
                                            </div>
                                            {{--  <label>Date of match</label>  --}}
                                            {{--  <input type="datetime-local" class="form-control" name="play_date" />  --}}
                                        </div>
                                    </div>
                                    @include('partials.formerrors')
                                    <button type="button" id="formSubmit" class="btn btn-primary">Submit</button>
                                    <button type="reset" class="btn btn-default">Clear</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
