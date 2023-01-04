<?php

declare(strict_types=1);

namespace App\Http\Livewire\Teams\Actions;

use LaravelViews\Views\View;
use LaravelViews\Actions\Action;

class RestoreTeamAction extends Action
{
    public $title = '';
    public $icon = 'eye';

    public function __construct()
    {
        parent::__construct();

        $this->title = 'Przywróć zespół';
    }

    public function handle($model, View $view): void
    {
        $view->dialog()->confirm([
            'title' => 'Przywracanie zespołu',
            'description' => 'Czy na pewno przywrócić zespół: ' . $model->name . ' ?',
            'icon' => 'question',
            'iconColor' => 'text-green-500',
            'accept' => [
                'label' => 'Tak',
                'method' => 'restore',
                'params' => $model->id
            ],
            'reject' => [
                'label' => 'Nie'
            ]
        ]);
    }

    public function  renderIf($model, View $view): mixed
    {
        return request()->user()->can('restore', $model);
    }
}
