@extends('layout')

@section('content')


<h1>Content</h1>


<p>
    <a href="/content/create/" class="btn btn-primary">Create</a>
</p>

<table class="table">
    <thead>
        <tr>
            <th>Title</th>
            <th>Published</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    @foreach($files as $file)
        <tr>
            <td>{{ $file['name'] }}</td>
            <td>{{ $file['published'] }}</td>
            <td><a href="/content/edit/{{ $file['file_name'] }}">Edit</a></td>
        </tr>
    @endforeach
    </tbody>
</table>

@endsection