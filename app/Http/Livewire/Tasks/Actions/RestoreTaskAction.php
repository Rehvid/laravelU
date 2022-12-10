<?php

namespace App\Http\Livewire\Tasks\Actions;

use LaravelViews\Views\View;
use LaravelViews\Actions\Action;

class RestoreTaskAction extends Action
{
    public $title = '';
    public $icon = 'eye';

    public function __construct()
    {
        parent::__construct();
        $this->title = 'Przywróć zadanie';
    }

    public function handle($model, View $view)
    {
        $view->dialog()->confirm([
            'title' => 'Przywracanie zadania',
            'description' => 'Czy na pewno przywrócić zadanie ' . $model->title,
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

    public function  renderIf($model, View $view)
    {
        return request()->user()->can('restore', $model);
    }
}
