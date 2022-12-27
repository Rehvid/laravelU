<?php

declare(strict_types=1);

namespace App\Http\Livewire\Tasks\Actions;

use LaravelViews\Actions\Action;
use LaravelViews\Views\View;

class SoftDeleteTaskAction extends Action
{
    public $title = '';
    public $icon = 'trash-2';
    public function __construct()
    {
        parent::__construct();
        $this->title = 'Usuń';
    }

    public function handle($model, View $view): void
    {
        $view->dialog()->confirm([
            'title' => 'Usuwanie zadania',
            'description' => 'Czy na pewno usunąć zadanie o tytule: ' . $model->title . ' ?',
            'icon' => 'question',
            'iconColor' => 'text-red-500',
            'accept' => [
                'label' => 'Tak',
                'method' => 'softDelete',
                'params' => $model->id
            ],
            'reject' => [
                'label' => 'Nie'
            ]
        ]);
    }

    public function renderIf($model, View $view): mixed
    {
        return request()->user()->can('delete', $model);
    }


}
