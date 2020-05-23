@extends('layout')

@section('content')

    <h1>Dashboard</h1>
    <hr>

    <h2>Content Types</h2>
    <ul class="list-group">

        @foreach($models as $model)

            <li class="list-group-item">
                <a href="/content/{{ $model["title"] }}/">{{ $model["title"] }}</a>
            </li>

        @endforeach

    </ul>

@endsection