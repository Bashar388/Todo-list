@extends('layouts.master')
@section('content')


    <br>
    <br>
    <br>
    <div id="main" class="main">
        <h1>Type</h1>
        <a href="{{route('type.create')}}">Add New Type</a>

        <table class="table">

            <tr>
                <th>Type Name</th>
                <th>view</th>

            </tr>

            <tbody>
            @foreach($types as $type)
                <tr>
                    <td>{{ $type->name }}</td>

                  <td><a href="{{route('type.show',$type->id)}}">Show Tasks</a></td>
                    <td>
                        <a href="{{route('type.edit',$type->id)}}">Edit</a>
                        <form action="{{ route('type.destroy', $type->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف المهمة؟');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">حذف</button>
                        </form>
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>
        <a href="{{route('dashboard')}}">Go To Home</a>
    </div>

@endsection
