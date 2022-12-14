<?php

declare(strict_types=1);

namespace App\Http\Livewire\Users;

use App\Http\Livewire\Current;
use App\Http\Livewire\Users\Actions\AssignAdminRoleAction;
use App\Http\Livewire\Users\Actions\AssignManagerRoleAction;
use App\Http\Livewire\Users\Actions\AssignUserToTeamAction;
use App\Http\Livewire\Users\Actions\RemoveAdminRoleAction;
use App\Http\Livewire\Users\Actions\RemoveManagerRoleAction;
use App\Http\Livewire\Users\Filters\EmailVerifiedFilter;
use App\Http\Livewire\Users\Filters\UsersRoleFilter;
use App\Http\Livewire\Users\Filters\UsersTeamFilter;
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

    protected $paginate = 5;

    /**
     * Sets the headers of the table as you want to be displayed
     *
     * @return array<string> Array of headers
     */
    public function headers(): array
    {
        return [
            Header::title(__('table.headers.name'))->sortBy('name'),
            Header::title(__('table.headers.team_name')),
            Header::title(__('table.headers.email'))->sortBy('email'),
            Header::title(__('table.headers.roles')),
            Header::title(__('table.headers.created_at'))->sortBy('created_at'),
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
            $model->team->name ?? __('table.row.notFoundTeam'),
            $model->email,
            $model->roles->implode('name', ','),
            $model->created_at,
        ];
    }

    protected function filters(): array
    {
        return [
            new UsersRoleFilter,
            new UsersTeamFilter,
            new EmailVerifiedFilter,
        ];
    }

    protected function actionsByRow(): array
    {
        return [
            new AssignAdminRoleAction,
            new AssignUserToTeamAction('users.change.status', 'Przypisz zespo??', 'layers'),
            new AssignManagerRoleAction,
            new RemoveAdminRoleAction,
            new RemoveManagerRoleAction,
        ];
    }
}
