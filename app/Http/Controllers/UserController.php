<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;

class UserController extends Controller
{

    public function index(): View
    {
        return view('users.index',[
            'users' => User::with('roles')->get()
        ]);
    }
}
