<?php

declare(strict_types=1);

namespace App\Http\Livewire\Users\Actions;

use Illuminate\Support\Facades\Auth;
use LaravelViews\Actions\Action;
use LaravelViews\Views\View;

class AssignManagerRoleAction extends Action
{
    public $title = '';
    public $icon = 'droplet';
    public function __construct()
    {
        $this->title = 'Assign Manager Role';
        parent::__construct();
    }

    public function handle($model, View $view): void
    {
        $model->assignRole(config('auth.roles.manager'));
        $view->notification()->success('Zaktualizowano', 'Ustawiono rolę manager dla ' . $model->name);
    }

    public function renderIf($model, View $view): bool
    {
        return Auth::user()->isAdmin()
            && !$model->hasRole(config('auth.roles.manager'));
    }

}
