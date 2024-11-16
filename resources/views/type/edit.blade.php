@extends('layouts.master')
@section('content')


    <br>
    <br>
    <br>
    <div id="main" class="main">
        <h1>Edit Type: {{ $type->name }}</h1>

        <form action="{{ route('type.update', $type->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Type Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $type->name }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Edit Type</button>
        </form>
    </div>


    <a href="{{route('type.index')}}">Go Back</a>


@endsection
