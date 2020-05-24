@extends('layout')

@section('content')

<h1>{{ $schema["title"] }}</h1>

<p>
    <a href="/content/{{ $model }}/create/" class="btn btn-primary">Create</a>
</p>

{{-- <pre>@json($schema, JSON_PRETTY_PRINT)</pre> --}}

@if (count($files) == 0)
    <p>No Records Found</p>
@else
    <table class="table">
        <thead>
            <tr>
                @foreach($schema["fields"] as $field => $properties)
                    <th>{{ $field }}</th>
                @endforeach

                <th></th>
            </tr>
        </thead>
        <tbody>

        @foreach($files as $file)
            <tr>
                @foreach($schema["fields"] as $field => $properties)
                    <td>{{ $file[$field] }}</td>
                @endforeach

                <td><a href="/content/{{ $model }}/{{ $file['file_name'] }}/edit/">Edit</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif

@endsection