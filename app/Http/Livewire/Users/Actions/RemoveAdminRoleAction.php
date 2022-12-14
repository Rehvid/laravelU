<?php

declare(strict_types=1);

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
        $this->title = 'Odbierz role admina';
        parent::__construct();
    }

    public function handle($model, View $view): void
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
