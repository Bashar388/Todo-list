<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = Type::all();

        return view('type.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('type.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',

        ]);


        Type::create([
            'name' => $request->input('name'),
        ]);

        return redirect()->route('type.index')->with('success', 'تم إضافة المهمة بنجاح!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $type = Type::with('tasks')->findOrFail($id);
        return view('type.show', compact('type'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $type = Type::findOrFail($id);

        return view('type.edit',compact('type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $type = Type::findOrFail($id);


        $request->validate([
            'name' => 'required|string|max:255',

        ]);


        $type->update([
            'name' => $request->input('name'),

        ]);
        return redirect()->route('type.index')->with('success', 'تم تحديث المهمة بنجاح!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (auth()->user()->is_admin) {

            $type = Type::findOrFail($id);


            $type->delete();
            return redirect()->route('type.index');
        }
    }
}
