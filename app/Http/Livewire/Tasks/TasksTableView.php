<?php

namespace App\Http\Livewire\Tasks;


use App\Models\Task;
use LaravelViews\Facades\Header;
use LaravelViews\Views\TableView;
use Illuminate\Contracts\Database\Eloquent\Builder;


use App\Http\Livewire\Tasks\Actions\EditTaskAction;
use App\Http\Livewire\Tasks\Actions\RestoreTaskAction;
use App\Http\Livewire\Tasks\Actions\SoftDeleteTaskAction;

use App\Http\Livewire\Tasks\Filters\SoftTaskDeleteFilter;
use WireUi\Traits\Actions;



class TasksTableView extends TableView
{

    use Actions;

    /**
     * Sets a model class to get the initial data
     */
    protected $model = Task::class;
    protected $paginate = 10;

    /**
     * Sets the headers of the table as you want to be displayed
     *
     * @return array<string> Array of headers
     */


    public $searchBy = [
        'user.name',
        'team.name',
        'status.name',
        'title',
        'deadline',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function headers(): array
    {

        return [
            Header::title('user')->sortBy('user'),
            Header::title('team')->sortBy('team'),
            Header::title('status')->sortBy('status'),
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
        return Task::query()->with('user', 'team', 'status')->withTrashed();
    }

    /**
     * Sets the data to every cell of a single row
     *
     * @param $model Current model for each row
     */
    public function row($model): array
    {
        return [
            $model->user->name,
            $model->team->name ?? '',
            $model->status->name ?? '',
            $model->title,
            $model->description,
            $model->deadline,
            $model->created_at,
            $model->updated_at,
            $model->deleted_at
        ];
    }

    protected function filters()
    {
        return [
            new SoftTaskDeleteFilter()
        ];
    }

    protected function actionsByRow()
    {
        return [
            new EditTaskAction('task.edit', 'Edytuj'),
            new RestoreTaskAction(),
            new SoftDeleteTaskAction(),
        ];
    }

    public function softDelete($id)
    {
        $task = Task::find($id);
        $task->delete();
        $this->notification()->success('Usunięto', 'Usunięto zadanie ' . $task->title);
    }

    public function restore($id)
    {
        $task = Task::withTrashed()->find($id);
        $task->restore();
        $this->notification()->success('Przywrócono zadanie ' . $task->name);
    }

}
