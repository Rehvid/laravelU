<?php

namespace App\Http\Livewire\Teams;

use App\Models\Team;
use LaravelViews\Facades\Header;
use LaravelViews\Views\TableView;
use Illuminate\Contracts\Database\Eloquent\Builder;

class TeamsTableView extends TableView
{
    /**
     * Sets a model class to get the initial data
     */
    protected $model = Team::class;

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
            Header::title('user_id')->sortBy('user_id'),
            Header::title('created_at')->sortBy('created_at'),
            Header::title('updated_at')->sortBy('updated_at'),
            Header::title('deleted_at')->sortBy('deleted_at'),
        ];
    }

    public function repository(): Builder
    {
        return Team::query()->withTrashed();
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
            $model->user_id,
            $model->created_at,
            $model->updated_at,
            $model->deleted_at,
        ];
    }
}
