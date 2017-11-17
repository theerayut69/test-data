@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-6">
            <form action="{{ route('league-create') }}" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label class="col-form-label" for="formGroupExampleInput">Example label</label>
                    <input type="text" class="form-control" name="name" placeholder="Name">
                </div>
                <div class="form-group">
                    <label class="col-form-label" for="formGroupExampleInput2">Another label</label>
                    <input type="text" class="form-control" name="description" placeholder="Description">
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</div>
@endsection
