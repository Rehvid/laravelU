<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;

class UserController extends Controller
{

    public function index(): View
    {
        $this->authorize('users.index');

        return view('users.index',[
            'users' => User::with('roles')->get()
        ]);
    }

    public function assignTeam(User $user): View
    {
        $this->authorize('users.assign_to_team');

        return view('users.form',[
            'user' => $user
        ]);
    }
}
