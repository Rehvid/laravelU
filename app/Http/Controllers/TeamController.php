<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index()
    {
        return view(
            'team.index',
            [
                'teams' => Team::withTrashed()->get(),
            ]
        );
    }

    public function create()
    {
        // $this->authorize('create', Status::class);
        // return view('status.form');
    }

    public function edit(Team $team)
    {
        // $this->authorize('update', $status);
        // return view('status.form', ['status' => $status]);
    }
}
