<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Status::class);
        return view(
            'status.index',
            [
                'statuses' => Status::withTrashed()->get(),
            ]
        );
    }

    public function create()
    {
        $this->authorize('create', Status::class);
        return view('status.form');
    }

    public function edit(Status $status)
    {
        $this->authorize('update', $status);
        return view('status.form', ['status' => $status]);
    }
}
