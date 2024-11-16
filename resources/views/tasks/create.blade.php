@extends('layouts.master')
@section('content')

<br>
<br>
<br>
<div class=id="main" class="main">
    <h1>Add New Task</h1>

    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Task Name</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="description">Discription</label>
            <textarea name="description" id="description" class="form-control" required></textarea>
        </div>

        <h3>User:</h3>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="selectAll" onclick="toggleSelectAll(this)">
            <label class="form-check-label" for="selectAll">Select All</label>
        </div>

        <div id="users">
            @foreach($users as $user)
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="user{{ $user->id }}" name="users[]" value="{{ $user->id }}">
                    <label class="form-check-label" for="user{{ $user->id }}">{{ $user->name }}</label>
                </div>
            @endforeach
        </div>
        <div class="form-group">
            <label for="type-id">Type Name</label>
            <select name="type_id">
                @foreach($type as $typ)
                    <option name="type_id" value="{{$typ->id}}">{{$typ->name}}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Add Task</button>
    </form>
</div>

<script>
    function toggleSelectAll(source) {
        const checkboxes = document.querySelectorAll('#users .form-check-input');
        checkboxes.forEach((checkbox) => {
            checkbox.checked = source.checked;
        });
    }
</script>
    <a href="{{route('tasks.index')}}">Go Back</a>

@endsection
