<?php

namespace App\Http\Livewire\Statuses;

use App\Http\Livewire\Statuses\Actions\EditStatusAction;
use App\Http\Livewire\Statuses\Actions\RestoreStatusAction;
use App\Http\Livewire\Statuses\Actions\SoftDeleteStatusAction;
use App\Http\Livewire\Statuses\Filters\SoftDeleteFilter;
use App\Models\Status;

use Illuminate\Database\Eloquent\Builder;
use LaravelViews\Facades\Header;
use LaravelViews\Views\TableView;
use WireUi\Traits\Actions;

class StatusesTableView extends TableView
{

    use Actions;

    public $searchBy = [
        'name',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    /**
     * Sets a model class to get the initial data
     */
    protected $paginate = 25;
    protected $model = Status::class;

    /**
     * Sets the headers of the table as you want to be displayed
     *
     * @return array<string> Array of headers
     */
    public function headers(): array
    {
        return [
            Header::title('name')->sortBy('name'),
            Header::title('created_at')->sortBy('created_at'),
            Header::title('updated_at')->sortBy('updated_at'),
            Header::title('deleted_at')->sortBy('deleted_at'),
        ];
    }

    public function repository(): Builder
    {
        return Status::query()->withTrashed();
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
            $model->created_at,
            $model->updated_at,
            $model->deleted_at,
        ];
    }

    protected function filters()
    {
        return [
            new SoftDeleteFilter()
        ];
    }

    protected function actionsByRow()
    {
        return [
            new EditStatusAction('status.edit', 'Edit'),
            new SoftDeleteStatusAction(),
            new RestoreStatusAction()
        ];
    }

    public function softDelete($id)
    {
        $status = Status::find($id);
        $status->delete();
        $this->notification()->success('Usunięto', 'Usunięto status ' . $status->name);
    }

    public function restore($id)
    {
        $status = Status::withTrashed()->find($id);
        $status->restore();
        $this->notification()->success('Przywrócono status ' . $status->name);
    }
}
