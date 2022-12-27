<?php

declare(strict_types=1);

namespace App\Http\Livewire\Tasks;


use App\Models\Task;
use App\Models\Status;
use WireUi\Traits\Actions;
use LaravelViews\Facades\Header;
use LaravelViews\Views\TableView;
use App\Http\Livewire\Tasks\Actions\DoneTaskAction;
use App\Http\Livewire\Tasks\Actions\EditTaskAction;
use Illuminate\Contracts\Database\Eloquent\Builder;
use App\Http\Livewire\Tasks\Filters\TasksTeamFilter;
use App\Http\Livewire\Tasks\Actions\RestoreTaskAction;
use App\Http\Livewire\Tasks\Filters\TasksStatusFilter;
use App\Http\Livewire\Tasks\Actions\SoftDeleteTaskAction;
use App\Http\Livewire\Tasks\Filters\SoftTaskDeleteFilter;



class TasksTableView extends TableView
{
    use Actions;

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
            Header::title('user'),
            Header::title('team'),
            Header::title('status'),
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


    public function softDelete($id): void
    {
        $task = Task::find($id);

        if ($task) {
            $task->delete();
            $this->notification()->success('Usunięto', 'Usunięto zadanie ' . $task->title);
        }
    }

    public function restore($id): void
    {
        $task = Task::withTrashed()->find($id);

        if ($task) {
            $task->restore();
            $this->notification()->success('Przywrócono zadanie ' . $task->name);
        }
    }

    public function doneTask($id): void
    {
        $task = Task::find($id);

        if ($task) {
            $statusId = Status::where('name', '=' , 'Wykonane')->value('id');

            $task->status_id = $statusId;

            $task->save();

            $this->notification()->success('Zadanie zostało ukończone ' . $task->name);
        }
    }

    protected function filters(): array
    {
        return [
            new SoftTaskDeleteFilter(),
            new TasksStatusFilter(),
            new TasksTeamFilter()
        ];
    }

    protected function actionsByRow(): array
    {
        return [
            new DoneTaskAction(),
            new EditTaskAction('task.edit', 'Edytuj'),
            new RestoreTaskAction(),
            new SoftDeleteTaskAction(),
        ];
    }

}
