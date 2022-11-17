<?php

namespace App\Http\Livewire\Users;

use App\Http\Livewire\Actions\AssignAdminRoleAction;
use App\Http\Livewire\Actions\AssignManagerRoleAction;
use App\Http\Livewire\Actions\RemoveAdminRoleAction;
use App\Http\Livewire\Actions\RemoveManagerRoleAction;
use App\Http\Livewire\Current;
use App\Http\Livewire\Users\Filters\EmailVerifiedFilter;
use App\Http\Livewire\Users\Filters\UsersRoleFilter;
use App\Models\User;
use LaravelViews\Facades\Header;
use LaravelViews\Views\TableView;

class UsersTableView extends TableView
{

    public $searchBy = [
        'name',
        'email',
        'roles.name',
        'created_at',
    ];
    /**
     * Sets a model class to get the initial data
     */
    protected $model = User::class;

    protected $paginate = 5;

    /**
     * Sets the headers of the table as you want to be displayed
     *
     * @return array<string> Array of headers
     */
    public function headers(): array
    {
        return [
            Header::title('name')->sortBy('name'),
            Header::title('email')->sortBy('email'),
            'roles',
            Header::title('created_at')->sortBy('created_at'),
        ];
    }

    /**
     * Sets the data to every cell of a single row
     *
     * @param $model Current model for each row
     */
    public function row($model): array
    {
        return [
            $model->name,
            $model->email,
            $model->roles->implode('name', ','),
            $model->created_at,
        ];
    }

    protected function filters()
    {
        return [
            new UsersRoleFilter,
            new EmailVerifiedFilter,
        ];
    }

    protected function actionsByRow()
    {
        return [
            new AssignAdminRoleAction,
            new AssignManagerRoleAction,
            new RemoveAdminRoleAction,
            new RemoveManagerRoleAction,
        ];
    }
}
