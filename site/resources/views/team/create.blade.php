@extends('layouts.clean')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-heading border bottom">
                    <h4 class="card-title">Team</h4>
                </div>
                <div class="card-block">
                    <div class="card-block">
                        <div class="row">
                            <div class="col-md-8 ml-auto mr-auto">
                                <form action="create" method="post" role="form" id="form-validation" novalidate="novalidate" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" class="form-control" name="name" placeholder="Enter your name" value="{{ old('name') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Logo</label>
                                                <input type="file" class="form-control" name="image" value="{{ old('image') }}"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Description</label>
                                                <textarea class="form-control" name="description" rows="5">{{ old('description') }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>League</label>
                                                <select class="form-control" name="league_id">
                                                    @if($leagues)
                                                        @foreach($leagues as $league)
                                                            <option value="{{ $league->id }}" @if(old('league_id') == $league->id) {{ 'selected' }} @endif>{{ $league->name }}</option>
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
