<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        return view(
            'task.index',
            [
                'tasks' => Task::withTrashed()->get(),
            ]
        );
    }

    public function create()
    {
        // $this->authorize('create', Status::class);
        // return view('status.form');
    }

    public function edit(Task $task)
    {
        // $this->authorize('update', $status);
        // return view('status.form', ['status' => $status]);
    }
}
