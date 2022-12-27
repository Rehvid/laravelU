<?php

declare(strict_types=1);

namespace App\Http\Livewire\Tasks;

use App\Models\Task;
use App\Models\User;
use App\Models\Status;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use WireUi\Traits\Actions;
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
            'title' => 'Tytuł zadania',
            'description' => 'Opis zadania',
            'user_id' => 'Uzytkownik',
            'status_id' => 'Status',
            'deadline' => 'Termin wykonania zadania'
        ];
    }

    public function mount(Task $task, Bool $editMode): void
    {
        $this->task = $task;
        $this->editMode = $editMode;
    }

    public function render(): View
    {
        return view('livewire.tasks.task-form', [
            'users' => $this->getUsers(),
            'statuses' => $this->getOptions()
        ]);
    }

    /**
     * @throws ValidationException
     */
    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName);
    }

    public function save(): void
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
                ? "Udało się zaktualizować zadanie"
                : "Udało się stworzyć nowe zadanie"
        );

        $this->editMode = true;
    }

    private function getUsers(): array
    {
        $users = User::select('id', 'name')->get();

        $usersOptions = [];

        foreach($users as ['id' => $id, 'name' => $name]) {
            $usersOptions[$id] = $name;
        }

        return $usersOptions;
    }

    private function getOptions(): array
    {
        $statuses = Status::select('id', 'name')->get();

        $statusesOptions = [];

        foreach($statuses as ['id' => $id, 'name' => $name]) {
            $statusesOptions[$id] = $name;
        }

        return $statusesOptions;
    }

}
