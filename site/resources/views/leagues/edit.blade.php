@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-6">
            <form action="{{ route('league-update', $league->id) }}" method="post">

            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="_method" value="PATCH">
                <div class="form-group">
                    <label class="col-form-label" for="formGroupExampleInput">League Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Name" value="{{ $league->name }}">
                </div>
                <div class="form-group">
                    <label class="col-form-label" for="formGroupExampleInput2">Description</label>
                    <input type="text" class="form-control" name="description" placeholder="Description" value="{{ $league->description }}">
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</div>
@endsection