<?php

declare(strict_types=1);

namespace App\Http\Livewire\Tasks\Actions;

use LaravelViews\Views\View;
use Illuminate\Support\Facades\Auth;
use LaravelViews\Actions\RedirectAction;

class StatusTaskAction extends RedirectAction
{
    public function __construct(string $to, string $title, string $icon = 'edit')
    {
        parent::__construct($to, $title, $icon);
    }

    public function renderIf($model, View $view): mixed
    {
        return request()->user()->can('changeStatus', $model)
            && !Auth::user()->isAdmin()
            && !Auth::user()->isManager();
    }
}
