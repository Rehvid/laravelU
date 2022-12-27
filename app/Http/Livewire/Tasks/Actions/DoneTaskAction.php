<?php

declare(strict_types=1);

namespace App\Http\Livewire\Tasks\Actions;

use LaravelViews\Views\View;
use LaravelViews\Actions\Action;

class DoneTaskAction extends Action
{
    public $title = '';
    public $icon = 'check-circle';

    public function __construct()
    {
        parent::__construct();

        $this->title = 'Zakończ zadanie';
    }


    public function handle($model, View $view): void
    {
        $view->dialog()->confirm([
            'title' => 'Zakończenie zadania',
            'description' => 'Czy na pewno zakończyć zadanie: ' . $model->title . ' ?',
            'icon' => 'question',
            'iconColor' => 'text-green-500',
            'accept' => [
                'label' => 'Tak',
                'method' => 'doneTask',
                'params' => $model->id
            ],
            'reject' => [
                'label' => 'Nie'
            ]
        ]);
    }

    public function renderIf($model, View $view): mixed
    {
        return request()->user()->can('done', $model);
    }
}
