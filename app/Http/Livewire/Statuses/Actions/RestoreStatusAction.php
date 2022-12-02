<?php

namespace App\Http\Livewire\Statuses\Actions;

use LaravelViews\Views\View;

class RestoreStatusAction extends \LaravelViews\Actions\Action
{
    public $title = '';
    public $icon = 'eye';

    public function __construct()
    {
        parent::__construct();
        $this->title = 'Przywróć status';
    }

    public function handle($model, View $view)
    {
        $view->dialog()->confirm([
            'title' => 'Przywracanie statusu',
            'description' => 'Czy na pewno przywrócić status ' . $model->name,
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
