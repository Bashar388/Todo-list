@extends('layouts.master')
@section('content')

<br>
<br>
<br>
<div id="main" class="main">
    <h1>Name: {{ $task->title }}</h1>
    <h3>Discreption:</h3>
    <p>{{ $task->description }}</p>

    <h3>Users:</h3>
    <ul>
        @foreach($task->users as $user)
            <li>
                {{ $user->name }}

                @if($user->pivot->is_completed)
                    <span class="text-success"> Yes</span>
                @else
                    <span class="text-danger"> No</span>
                @endif
            </li>
        @endforeach
    </ul>
    <a href="{{ route('tasks.index') }}" class="btn btn-secondary">العودة إلى قائمة المهام</a>
</div>

@endsection
