@extends('layout')

@section('content')
    <h1>Create</h1>

    {{-- <pre>@json($schema, JSON_PRETTY_PRINT)</pre> --}}

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/content/{{ $model }}" method="post">

        @csrf

        @foreach($schema["fields"] as $field => $properties)
            <div class="form-group">
                <label for="{{ $field }}-input">{{ $field }}</label>
                <input 
                    type="text" 
                    name="{{ $field }}" 
                    class="form-control" 
                    id="{{ $field }}-input"
                    value={{ old($field) }}
                >
            </div>
        @endforeach
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection