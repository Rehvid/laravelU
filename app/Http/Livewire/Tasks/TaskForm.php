<?php

namespace App\Http\Livewire\Tasks;

use App\Models\Task;
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
            'task.name' => [
                'required',
                'string',
                'min:2',
                'unique:tasks,name' .
                    ($this->editMode ? (',' . $this->task->id) : ''),
            ],
        ];
    }

    public function validationAttributes(): array
    {
        return [
            'name' => 'nazwa'
        ];
    }

    public function mount(Task $task, Bool $editMode)
    {
        $this->task = $task;
        $this->editMode = $editMode;
    }

    public function render()
    {
        return view('livewire.tasks.task-form');
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

}
