<?php

declare(strict_types=1);

namespace App\Http\Livewire\Users\Actions;

use LaravelViews\Views\View;
use Illuminate\Support\Facades\Auth;
use LaravelViews\Actions\RedirectAction;

class AssignUserToTeamAction extends RedirectAction
{
    public function __construct(string $to, string $title, string $icon = 'edit')
    {
        parent::__construct($to, $title, $icon);
    }

    public function renderIf($model, View $view): mixed
    {

        if (Auth::user()->isAdmin()) {
            return request()->user()->can('assignTeam', $model);
        }

        return request()->user()->can('assignTeam', $model)
            && $model->team_id === 0
            && !$model->isAdmin();
    }

}
