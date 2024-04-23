<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TodoTaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();

        return view('home', [
            'tasks' => $tasks,
        ]);
    }

    public function store(Request $request)
    {
       $request->validate([
            'task'=> 'required|min:5'
       ],
    [
        'task.required'=> 'tugas harus diisi',
        'task.min'=>'tugas minimal 5 karakter',
    ]);
       Task::create([
            'task' => $request->task,
            'tanggal' =>  NOW(),
       ]);
        return redirect('/');
    }

    public function destroy(Request $request)
    {
        Task::destroy($request->id);
        return redirect('/')-> with('success', 'Post has been deleted!');
    }
}