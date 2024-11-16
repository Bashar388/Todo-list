@extends('layouts.master')
@section('content')


<br>
<br>
<br>
<div id="main" class="main">
    <h1>Tasks</h1>
  <a href="{{route('tasks.create')}}">Add New Task</a>

    <table class="table">

        <tr>
            <th>Task Name</th>
            <th>Description</th>
            <th>User</th>
            <th>action</th>
            <th>View</th>
        </tr>

        <tbody>
        @foreach($tasks as $task)
            <tr>
                <td>{{ $task->title }}</td>
                <td>{{ $task->description }}</td>
                <td>
                    @foreach($task->users as $user)
                        {{ $user->name }}<br>
                    @endforeach
                </td>
                <td>
                    <a href="{{route('tasks.edit',$task->id)}}">Edit</a>
                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف المهمة؟');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">حذف</button>
                    </form>
                </td>
                <td><a href="{{route('tasks.show',$task->id)}}">View</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <a href="{{route('dashboard')}}">Go To Home</a>
</div>

@endsection
