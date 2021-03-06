
@extends('layout')

@section('content')
    <h1>Edit</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- <pre>@json($schema, JSON_PRETTY_PRINT)</pre> --}}

    <form action="/content/{{ $model }}/{{ $page['file_name'] }}/" method="post">
        @csrf
        @method("patch")

        @foreach($schema["fields"] as $field => $properties)
            <div class="form-group">
                <label for="{{ $field }}-input">{{ $field }}</label>
                <input 
                    type="text" 
                    name="{{ $field }}" 
                    class="form-control" 
                    id="{{ $field }}-input" 
                    value="{{ old($field) ?? $page[$field] }}"
                >
            </div>
        @endforeach

        <button type="submit" class="btn btn-primary">Update</button>
    </form>

    <form action="/content/{{ $model }}/{{ $page['file_name'] }}/" method="post">
        @csrf
        @method("delete")

        <p style="margin-top: 30px;">
            <button type="submit" class="btn btn-danger">Delete</button>
        </p>
    </form>
@endsection