<?php

declare(strict_types=1);

namespace App\Http\Livewire\Users\Actions;

use Illuminate\Support\Facades\Auth;
use LaravelViews\Actions\Action;
use LaravelViews\Views\View;

class RemoveManagerRoleAction extends Action
{
    public $title = '';
    public $icon = 'droplet';
    public function __construct()
    {
        $this->title = 'Odbierz role managera';
        parent::__construct();
    }

    public function handle($model, View $view): void
    {
        $model->removeRole(config('auth.roles.manager'));
        $view->notification()->success('Zaktualizowano', 'Odebrano  rolę managera dla ' . $model->name);
    }

    public function renderIf($model, View $view): bool
    {
        return Auth::user()->isAdmin()
            && $model->hasRole(config('auth.roles.manager'));
    }

}
