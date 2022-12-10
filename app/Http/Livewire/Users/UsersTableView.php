<?php

namespace App\Http\Livewire\Users;

use App\Http\Livewire\Current;
use App\Http\Livewire\Users\Actions\AssignAdminRoleAction;
use App\Http\Livewire\Users\Actions\AssignManagerRoleAction;
use App\Http\Livewire\Users\Actions\RemoveAdminRoleAction;
use App\Http\Livewire\Users\Actions\RemoveManagerRoleAction;
use App\Http\Livewire\Users\Filters\EmailVerifiedFilter;
use App\Http\Livewire\Users\Filters\UsersRoleFilter;
use App\Models\User;
use LaravelViews\Facades\Header;
use LaravelViews\Views\TableView;
use WireUi\Traits\Actions;

class UsersTableView extends TableView
{

    use Actions;

    public $searchBy = [
        'name',
        'team.name',
        'email',
        'roles.name',
        'created_at',
    ];
    /**
     * Sets a model class to get the initial data
     */
    protected $model = User::class;

    protected $paginate = 25;

    /**
     * Sets the headers of the table as you want to be displayed
     *
     * @return array<string> Array of headers
     */
    public function headers(): array
    {
        return [
            Header::title('name')->sortBy('name'),
            Header::title('team_name'),
            Header::title('email')->sortBy('email'),
            Header::title('roles'),
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
            $model->team->name,
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
