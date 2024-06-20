<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoretodoRequest;
use App\Http\Requests\UpdatetodoRequest;
use App\Models\todo;

use Inertia\Inertia;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todos = Todo::get();

        return Inertia::render('Todos/Index', [
            'todos' => $todos,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Todos/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoretodoRequest $request)
    {
        Todo::create([	
            'title' => $request->title,	
            'body' => $request->body,	
        ]);	
	
        return to_route('todo.index')->with([	
             'message' => '登録しました。',	
             'status' => 'sucess',	
        ]);	
    }

    /**
     * Display the specified resource.
     */
    public function show(todo $todo)
    {
        return Inertia::render('Todos/Show', [
            'todo' => $todo,
         ]); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(todo $todo)
    {
        return Inertia::render('Todos/Edit', [
            'todo' => $todo,
         ]); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatetodoRequest $request, todo $todo)
    {
        $todo->title = $request->title;
        $todo->body = $request->body;
        $todo->save();

        return to_route('todo.index')->with([
           'message' => '登録しました。',
           'status' => 'sucess',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(todo $todo)
    {
        $todo->delete();

        return to_route('todo.index')->with([
           'message' => '削除しました。',
           'status' => 'damger',
        ]);
    }
}
