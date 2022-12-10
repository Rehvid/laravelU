<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Team::class);
        
        return view(
            'team.index',
            [
                'teams' => Team::with('user')->withTrashed()->get(),
            ]
        );
    }

}
