@extends('layouts.master')
@section('content')

    <br>
    <br>
    <br>
    <div id="main" class="main">
        <h1>Add New Task</h1>

        <form action="{{ route('type.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Task Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Add Task</button>
        </form>
    </div>

    <a href="{{route('type.index')}}">Go Back</a>

@endsection
