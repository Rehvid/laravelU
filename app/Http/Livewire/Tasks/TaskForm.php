<?php

namespace App\Http\Livewire\Tasks;

use App\Models\Task;
use App\Models\Team;
use App\Models\User;
use App\Models\Status;
use Livewire\Component;
use WireUi\Traits\Actions;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TaskForm extends Component
{
    use Actions;
    use AuthorizesRequests;

    public Task $task;
    public Bool $editMode;


    public function rules(): array
    {
        return [
            'task.title' => [
                'required',
                'string',
                'min:2',
                'unique:tasks,title' .
                    ($this->editMode ? (',' . $this->task->id) : ''),
            ],
            'task.description' => [
                'required',
                'string',
                'min:2',
            ],
            'task.user_id' => [
                'required'
            ],
            'task.status_id' => [
                'required'
            ],
            'task.deadline' => [
                'required'
            ]
        ];
    }

    public function validationAttributes(): array
    {
        return [
            'title' => 'nazwa'
        ];
    }

    public function mount(Task $task, Bool $editMode)
    {
        $this->task = $task;
        $this->editMode = $editMode;
    }

    public function render()
    {
        return view('livewire.tasks.task-form', [
            'users' => $this->getUserOptions(),
            'statuses' => $this->getStatusOptions()
        ]);
    }

    /**
     * @throws ValidationException
     */
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        if ($this->editMode) {
            $this->authorize('update', $this->task);
        } else {
            $this->authorize('create', Task::class);
        }

        $this->validate();

        $this->task->team_id = User::find($this->task->user_id)->team_id;

        $this->task->save();

        $this->notification()->success(
             $this->editMode
                ? "Zaktualizowano zadanie"
                : "Dodano Zadanie",
            $this->editMode
                ? "Udało się zaktualizować  zadanie"
                : "Udało się stworzyć nowy zadanie"
        );

        $this->editMode = true;
    }

    private function getUserOptions(): array
    {
        $users = User::select('id', 'name')->get();

        $users_options = [];

        foreach($users as ['id' => $id, 'name' => $name]) {
            $users_options[$id] = $name;
        }

        return $users_options;
    }

    private function getStatusOptions(): array
    {
        $statuses = Status::select('id', 'name')->get();

        $statuses_options = [];

        foreach($statuses as ['id' => $id, 'name' => $name]) {
            $statuses_options[$id] = $name;
        }

        return $statuses_options;
    }

}
