<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Contracts\View\View;


class TeamController extends Controller
{
    public function index(): View
    {
        $this->authorize('viewAny', Team::class);

        return view('team.index',[
                'teams' => Team::withTrashed()->get(),
            ]
        );
    }

    public function create(): View
    {
        $this->authorize('create', Team::class);

        return view('team.form');
    }

}
