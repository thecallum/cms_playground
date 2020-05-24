@extends('layout')

@section('content')
    <h1>Create</h1>

    <form action="/content/{{ $model }}" method="post">

        @csrf

        <div class="form-group">
            <label for="name-input">Name</label>
            <input type="text" name="name" class="form-control" id="name-input">
        </div>

        <div class="form-group">
            <label for="published-input">Published</label>
            <input type="text" name="published" class="form-control" id="published-input">
        </div>

        <div class="form-group">
            <label for="content-input">Content</label>
            <input type="text" name="content" class="form-control" id="content-input">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection