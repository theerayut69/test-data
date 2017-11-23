@extends('layouts.aspire')

@section('content')

<div class="container-fluid">
    <div class="row" style="margin-top: 50px;">
        <div class="col-md-12">
            <div class="card">
                <div class="card-heading border bottom">
                    <h4 class="card-title">Team</h4>
                </div>
                <div class="card-block">
                    <div class="card-block">
                        <div class="row">
                            <div class="col-md-8 ml-auto mr-auto">
                                <form action="{{ route('team-update', $team->id) }}" method="post" role="form" id="form-validation" novalidate="novalidate" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="_method" value="PATCH">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" class="form-control" name="name" placeholder="Enter your name" value="{{ $team->name }}" required="" minlength="8" aria-required="true">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Logo</label>
                                                <input type="file" class="form-control" name="image"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Description</label>
                                                <input type="text" class="form-control" name="description" placeholder="Enter your Description" value="{{ $team->description }}" required="" minlength="8" aria-required="true">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>League</label>
                                                <select class="form-control" name="league_id">
                                                    @if($leagues)
                                                    @foreach($leagues as $league)
                                                        @if($team->league_id == $league->id)
                                                        <option value="{{ $league->id }}" selected>{{ $league->name }}</option>
                                                        @else
                                                        <option value="{{ $league->id }}" >{{ $league->name }}</option>
                                                        @endif
                                                    @endforeach
                                                    @else
                                                    <option value="">null</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    @include('partials.formerrors')
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button class="btn btn-default">Clear</button>
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