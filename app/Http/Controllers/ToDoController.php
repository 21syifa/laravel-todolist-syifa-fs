<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\Todo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class ToDoController extends Controller
{
    public function index(): View
    {
        $all_todos = Todo::all()->sortByDesc('id');
        return view('todolist', ['todos' => $all_todos]);

    }

    public function add(Request $request): RedirectResponse
    {
        $todo = new Todo;
        $todo->todo = $request->todo;
        $todo->status = false;
        $todo->save();

        return redirect('/');
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $todo = Todo::find($id);
        $todo->status = !$todo->status;
        $todo->save();


        return redirect('/');
    }

    public function delete(Request $request, $id): RedirectResponse
    {
        $todo = Todo::find($id);
        $todo->delete();

        return redirect('/');
    }
}
