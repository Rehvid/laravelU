<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function index()
    {
        return view(
            'status.index',
            [
                'statuses' => Status::withTrashed()->get(),
            ]
        );
    }

    public function create()
    {
        return view('status.form');
    }

    public function edit(Status $status)
    {
        return view('status.form', ['status' => $status]);
    }
}
