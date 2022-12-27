<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Contracts\View\View;

class TaskController extends Controller
{
    public function index(): View
    {
        $this->authorize('viewAny', Task::class);

        return view('task.index',[
            'tasks' => Task::with('user', 'status', 'team')->withTrashed()->get()
        ]);
    }

    public function create(): View
    {
        $this->authorize('create', Task::class);

        return view('task.form');
    }

    public function edit(Task $task): View
    {
        $this->authorize('update', $task);

        return view('task.form', ['task' => $task]);
    }
}
