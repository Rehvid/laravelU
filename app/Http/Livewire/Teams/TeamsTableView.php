<?php

namespace App\Http\Livewire\Teams;

use App\Models\Team;
use LaravelViews\Facades\Header;
use LaravelViews\Views\TableView;
use App\Http\Livewire\Teams\Actions\EditTeamAction;
use Illuminate\Contracts\Database\Eloquent\Builder;
use App\Http\Livewire\Teams\Actions\RestoreTeamAction;
use App\Http\Livewire\Teams\Actions\SoftDeleteTeamAction;
use App\Http\Livewire\Teams\Filters\SoftTeamDeleteFilter;
use WireUi\Traits\Actions;

class TeamsTableView extends TableView
{

    use Actions;

    /**
     * Sets a model class to get the initial data
     */
    protected $model = Team::class;

    protected $paginate = 25;

    public $searchBy = [
        'name',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

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
            $model->created_at,
            $model->updated_at,
            $model->deleted_at,
        ];
    }

    protected function filters()
    {
        return [
            new SoftTeamDeleteFilter()
        ];
    }

    protected function actionsByRow()
    {
        return [
            new EditTeamAction('Team.edit', 'Edit'),
            new SoftDeleteTeamAction(),
            new RestoreTeamAction()
        ];
    }

    public function softDelete($id)
    {

        $team = Team::find($id);

        if ($team) {
            $team->delete();
            $this->notification()->success('Usunięto', 'Usunięto Team ' . $team->name);
        }

    }

    public function restore($id)
    {
        $team = Team::withTrashed()->find($id);

        if ($team) {
            $team->restore();
            $this->notification()->success('Przywrócono Team ' . $team->name);
        }

    }

}
