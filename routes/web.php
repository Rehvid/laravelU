<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StatusController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::group([
        'as' => 'users.',
        'prefix' => 'users'
    ], function() {
        Route::get('', [UserController::class, 'index'])
            ->name('index')
            ->middleware(['permission:users.index']);
    });


    Route::resource('status', StatusController::class)->only([
            'index', 'create', 'edit'
    ]);

    Route::resource('task', TaskController::class)->only([
        'index', 'create', 'edit'
    ]);

    Route::resource('team', TeamController::class)->only([
        'index', 'create', 'edit'
    ]);

});
