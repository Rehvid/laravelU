<?php

declare(strict_types=1);

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

    public function handle($model, View $view): void
    {
        $view->dialog()->confirm([
            'title' => 'Usuwanie kategorii',
            'description' => 'Czy na pewno usunąć kategorię: ' . $model->name . ' ?',
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

    public function  renderIf($model, View $view): mixed
    {
        return request()->user()->can('delete', $model);
    }


}
