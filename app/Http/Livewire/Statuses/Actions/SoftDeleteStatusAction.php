<?php

namespace App\Http\Livewire\Statuses\Actions;

use LaravelViews\Actions\Action;
use LaravelViews\Views\View;

class SoftDeleteStatusAction extends Action
{
    public $title = '';
    public $icon = 'trash-2';
    public function __construct()
    {
        parent::__construct();
        $this->title = 'Usuń';
    }

    public function handle($model, View $view)
    {
        $view->dialog()->confirm([
            'title' => 'Usuwanie kategorii',
            'description' => 'Czy na pewno usunąć ' . $model->name,
            'icon' => 'question',
            'iconColor' => 'text-red-500',
            'accept' => [
                'label' => 'Tak',
                'method' => 'softDelete',
                'params' => $model->id
            ],
            'reject' => [
                'label' => 'no'
            ]
        ]);
    }

    public function  renderIf($model, View $view)
    {
        return request()->user()->can('delete', $model);
    }


}
