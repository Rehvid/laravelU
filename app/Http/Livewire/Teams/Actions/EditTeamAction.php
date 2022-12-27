<?php

declare(strict_types=1);

namespace App\Http\Livewire\Teams\Actions;

use LaravelViews\Actions\RedirectAction;
use LaravelViews\Views\View;

class EditTeamAction extends RedirectAction
{
    public function __construct(string $to, string $title, string $icon = 'edit')
    {
        parent::__construct($to, $title, $icon);
    }

    public function renderIf($model, View $view): mixed
    {
        return request()->user()->can('update', $model);
    }
}
