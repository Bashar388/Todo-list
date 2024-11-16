@extends('layouts.master')
@section('content')

    <br>
    <br>
    <br>
    <div id="main" class="main">
        <h1>Name: {{ $type->name }}</h1>


        <h3>Tasks:</h3>
        <ul>
            @foreach($type->tasks as $task)
                <li>
                    {{ $task->title }}
                </li>
            @endforeach
        </ul>
        <a href="{{ route('type.index') }}" class="btn btn-secondary">Go Back</a>
    </div>

@endsection
