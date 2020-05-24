@extends('layout')

@section('content')

<h1>{{ $title }}</h1>

<p>
    <a href="/content/{{ $model }}/create/" class="btn btn-primary">Create</a>
</p>

@if (count($files) == 0)
    <p>No Records Found</p>
@else
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
                <td><a href="/content/{{ $model }}/{{ $file['file_name'] }}/edit/">Edit</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif

@endsection