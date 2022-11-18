<?php

namespace App\Http\Livewire\Actions;

use Illuminate\Support\Facades\Auth;
use LaravelViews\Actions\Action;
use LaravelViews\Views\View;

class RemoveManagerRoleAction extends Action
{
    public $title = '';
    public $icon = 'droplet';
    public function __construct()
    {
        $this->title = 'Remove Manager Role';
        parent::__construct();
    }

    public function handle($model, View $view)
    {
        $model->removeRole(config('auth.roles.manager'));
        $this->success('Udało się usunać role Managera');
    }

    public function renderIf($model, View $view): bool
    {
        return Auth::user()->isAdmin()
            && $model->hasRole(config('auth.roles.manager'));
    }

}
