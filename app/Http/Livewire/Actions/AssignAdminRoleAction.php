<?php

namespace App\Http\Livewire\Actions;

use Illuminate\Support\Facades\Auth;
use LaravelViews\Actions\Action;
use LaravelViews\Views\View;

class AssignAdminRoleAction extends Action
{
    public $title = '';
    public $icon = 'shield';
    public function __construct()
    {
        $this->title = 'Assign admin role';
        parent::__construct();
    }

    public function handle($model, View $view)
    {
        $model->assignRole(config('auth.roles.admin'));
        $this->success('Udało się');
    }

    public function renderIf($model, View $view): bool
    {
        return Auth::user()->isAdmin()
            && !$model->hasRole(config('auth.roles.admin'));
    }

}
