<?php

namespace App\Http\Controllers;

declare(strict_types=1);

use App\Models\Status;
use Illuminate\Contracts\View\View;

class StatusController extends Controller
{
    public function index(): View
    {
        $this->authorize('viewAny', Status::class);

        return view('status.index',[
            'statuses' => Status::withTrashed()->get()
        ]);
    }

    public function create(): View
    {
        $this->authorize('create', Status::class);

        return view('status.form');
    }

    public function edit(Status $status): View
    {
        $this->authorize('update', $status);
        
        return view('status.form', ['status' => $status]);
    }
}
