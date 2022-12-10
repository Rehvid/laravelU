<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Task::class);
        return view(
            'task.index',
            [
                'tasks' => Task::with('user', 'status', 'team')->withTrashed()->get(),
            ]
        );
    }

    public function create()
    {
        $this->authorize('create', Task::class);
        return view('task.form');
    }

    public function edit(Task $task)
    {
        $this->authorize('update', $task);
        return view('task.form', ['task' => $task]);
    }
}
