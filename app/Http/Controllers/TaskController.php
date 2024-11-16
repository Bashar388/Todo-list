<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
//    public function __construct()
//    {
//
//        $this->middleware('admin')->only(['create', 'store', 'edit', 'update', 'destroy']);
//    }
    public function index()
    {
        $tasks = Task::with('users')->get();

        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::where('is_admin','false')->get();
        $type=Type::all();
        return view('tasks.create', compact('users','type'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'users' => 'array',
            'users.*' => 'exists:users,id',
            'type_id' => 'required|exists:types,id',
        ]);


        $task = Task::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
             'type_id'=>$request->input('type_id'),
        ]);


        if ($request->has('users')) {
            $task->users()->attach($request->input('users'));
        }

        return redirect()->route('tasks.index')->with('success', 'تم إضافة المهمة بنجاح!');
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        $task = Task::with('users')->findOrFail($id);
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $task = Task::findOrFail($id);
        $users = User::where('is_admin','false')->get();
        $type=Type::all();
        return view('tasks.edit', compact('task', 'users','type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);


        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'users' => 'array',
            'users.*' => 'exists:users,id',
            'type_id' => 'required|exists:types,id',
        ]);


        $task->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'type_id'=>$request->input('type_id'),
        ]);


        $task->users()->sync($request->input('users', []));

        return redirect()->route('tasks.index')->with('success', 'تم تحديث المهمة بنجاح!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (auth()->user()->is_admin) {

            $task = Task::findOrFail($id);


            $task->delete();
            return redirect()->route('tasks.index');
        }
    }
    public function indexuser()
    {

        $tasks = auth()->user()->tasks;

        return view('user.index', compact('tasks'));
    }

    public function updatecompleted(Request $request, $id)
    {
        $task = Task::findOrFail($id);


        if ($task->users->contains(auth()->user()->id)) {

            $isCompleted = $request->input('is_completed') == '1';


            $task->users()->syncWithoutDetaching([
                auth()->user()->id => ['is_completed' => $isCompleted]
            ]);
            return redirect()->route('user.tasks.index');
        }
    }
}
