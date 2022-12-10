<?php

namespace App\Http\Livewire\Tasks;

use App\Models\Task;
use LaravelViews\Facades\Header;
use LaravelViews\Views\TableView;
use Illuminate\Contracts\Database\Eloquent\Builder;

class TasksTableView extends TableView
{
    /**
     * Sets a model class to get the initial data
     */
    protected $model = Task::class;
    protected $paginate = 5;

    /**
     * Sets the headers of the table as you want to be displayed
     *
     * @return array<string> Array of headers
     */
    public function headers(): array
    {
        return [
            Header::title('user_id')->sortBy('user_id'),
            Header::title('team_id')->sortBy('team_id'),
            Header::title('status_id')->sortBy('status_id'),
            Header::title('title')->sortBy('title'),
            Header::title('description')->sortBy('description'),
            Header::title('deadline')->sortBy('deadline'),
            Header::title('created_at')->sortBy('created_at'),
            Header::title('updated_at')->sortBy('updated_at'),
            Header::title('deleted_at')->sortBy('deleted_at'),
        ];
    }

    public function repository(): Builder
    {
        return Task::query()->withTrashed();
    }

    /**
     * Sets the data to every cell of a single row
     *
     * @param $model Current model for each row
     */
    public function row($model): array
    {
        return [
            $model->user_id,
            $model->team_id,
            $model->status_id,
            $model->title,
            $model->description,
            $model->deadline,
            $model->created_at,
            $model->updated_at,
            $model->deleted_at
        ];
    }
}
