<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use App\Models\todo;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TodoController extends Controller
{
    //
    public function index(){
        $todos = Todo::all();
        return view('todos.index', [
            'todos' => $todos
        ]);
    }
    public function create(){
        return view('todos.create');
    }

    public function store(TodoRequest $request){

        todo::create([
            'title' => $request->title,
            'description'=>$request->description,
            'is_completed' => 0
        ]);


        $request->session()->flash('alert-success', 'Todo created successfully');

        return to_route('todos.index');
    }

    public function show($id) {
        $todo = todo::find($id);
        if (! $todo) {
            request()->session()->flash('error', 'Unable to find todo');
            return to_route('todos.index')->withErrors([
                'error'=>'Unable to find todo'
            ]);
        }
        return view('todos.show', ['todo' => $todo]);
    }

    public function edit($id){
        $todo = todo::find($id);
        if (! $todo) {
            request()->session()->flash('error', 'Unable to find todo');
            return to_route('todos.index')->withErrors([
                'error'=>'Unable to find todo'
            ]);
        }
        return view('todos.edit', ['todo' => $todo]);
    }

    public function update(TodoRequest $request)
    {
        $todo = todo::find($request->todo_id);
        if (! $todo) {
            request()->session()->flash('error', 'Unable to find todo');
            return to_route('todos.index')->withErrors([
                'error'=>'Unable to find todo'
            ]);
        }
        $todo->update([
            'title' => $request->title,
            'description' => $request -> description,
            'is_completed' => $request -> is_completed
        ]);

        $request->session()->flash('alert-info', 'Todo updated successfully');

        return to_route('todos.index');
    }

    public function destroy(Request $request) {
        $todo = todo::find($request->todo_id);
        if (! $todo) {
            request()->session()->flash('error', 'Unable to find todo');
            return to_route('todos.index')->withErrors([
                'error'=>'Unable to find todo'
            ]);
        }
        $todo->delete();
        $request->session()->flash('alert-success', 'Todo Deleted successfully');
        return to_route('todos.index');

    }
}
