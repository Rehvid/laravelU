<?php

namespace App\Http\Livewire\Users\Actions;

use Illuminate\Support\Facades\Auth;
use LaravelViews\Actions\Action;
use LaravelViews\Views\View;

class RemoveAdminRoleAction extends Action
{
    public $title = '';
    public $icon = 'shield';
    public function __construct()
    {
        $this->title = 'Remove admin role';
        parent::__construct();
    }

    public function handle($model, View $view)
    {
        $model->removeRole(config('auth.roles.admin'));
        $view->notification()->success('Zaktualizowano', 'Odebrano  rolę admina dla ' . $model->name);
    }

    public function renderIf($model, View $view): bool
    {
        return Auth::user()->isAdmin()
            && $model->hasRole(config('auth.roles.admin'));
    }

}
