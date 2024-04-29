<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTodoRequest;
use App\Http\Requests\UpdateTodoRequest;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Todo::where('user_id', auth()->user()->id)->get();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTodoRequest $request)
    {
        $request->validate([
            'title' => 'required|string',
            'completed' => 'required|boolean'
        ]);

        $todo = Todo::create([
            'user_id' => auth()->user()->id,
            'title' => $request->title,
            'completed' => $request->completed,
        ]);

        return response($todo, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Todo $todo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTodoRequest $request, Todo $todo)
    {

        if ($todo->user_id !== auth()->user()->id) {
            return response()->json('Unauthorized', 401);
        }

        $data = $request->validate([
            'title' => 'required|string',
            'completed' => 'required|boolean'
        ]);

        $todo->update($data);

        return response($todo, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {

        if ($todo->user_id !== auth()->user()->id) {
            return response()->json('Unauthorized', 401);
        }

        $todo->delete();

        return response('Delted Todo Item', 200);

    }

    public function destroyCompleted(Request $request)
    {

        $todosToDelete = $request->todos;

        $userTodoIds = auth()->user()->todos->map(function ($todo) {
            return $todo->id;
        });

        $valid = collect($todosToDelete)->every(function ($value, $key) use ($userTodoIds) {
            return $userTodoIds->contains($value);
        });

        if (!$valid) {
            return response()->json('Unauthorized', 401);
        }
        

        $request->validate([
            'todos' => 'required|array',
        ]);

        Todo::destroy($request->todos);

        return response('Deleted', 200);
    }

    public function updateAll(Request $request)
    {
        $data = $request->validate([
            'completed' => 'required|boolean',
        ]);

        Todo::where('user_id', auth()->user()->id)->update($data); 

        return response('Updated', 200);
    }
}
