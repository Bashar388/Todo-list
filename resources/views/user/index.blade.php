@extends('layouts.master')
@section('content')

<br>
<br>
<br>
<div id="main" class="main">
    <h1>Your Tasks</h1>

    @if($tasks->isEmpty())
        <p>No Tasks</p>
    @else
        <table class="table">
            <thead>
            <tr>
                <th>Task</th>
                <th>Discrption</th>
                <th>Status</th>
                <th>Mark as completed</th>
            </tr>
            </thead>
            <tbody>
            @foreach($tasks as $task)
                <tr>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->description }}</td>
                    <td>
                        @if($task->pivot->is_completed)
                            <span class="text-success">Yes</span>
                        @else
                            <span class="text-danger">No</span>
                        @endif
                    </td>
                    @if(!$task->pivot->is_completed)
                    <td>

                        <form action="{{ route('tasks.status.update', $task->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <input type="hidden" name="is_completed" value="{{ $task->pivot->is_completed ? '0' : '1' }}">
                            <button type="submit" class="btn btn-primary">
                                {{ $task->pivot->is_completed ? 'No Completed' : 'Completed' }}
                            </button>
                        </form>

                    </td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif


</div>
<a href="{{route('dashboard')}}">Go To Home</a>

@endsection
