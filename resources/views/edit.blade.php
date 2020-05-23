@extends('layout')

@section('content')
    <h1>Edit</h1>

    <form action="/content/{{ $page['file_name'] }}/" method="post">

        @csrf

        @method("patch")

        <div class="form-group">
            <label for="name-input">Name</label>
            <input type="text" name="name" class="form-control" id="name-input" value="{{ $page['name'] }}">
        </div>

        <div class="form-group">
            <label for="published-input">Published</label>
            <input type="text" name="published" class="form-control" id="published-input" value="{{ $page['published'] }}">
        </div>

        <div class="form-group">
            <label for="content-input">Content</label>
            <input type="text" name="content" class="form-control" id="content-input" value="{{ $page['content'] }}">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection