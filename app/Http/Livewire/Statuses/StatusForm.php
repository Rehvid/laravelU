<?php

namespace App\Http\Livewire\Statuses;

use App\Models\Status;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use WireUi\Traits\Actions;

class StatusForm extends Component
{
    use Actions;

    public Status $status;
    public Bool $editMode;


    public function rules(): array
    {
        return [
            'status.name' => [
                'required',
                'string',
                'min:2',
                'unique:statuses,name' .
                    ($this->editMode ? (',' . $this->status->id) : ''),
            ],
        ];
    }

    public function validationAttributes(): array
    {
        return [
            'name' => 'nazwa'
        ];
    }

    public function mount(Status $status, Bool $editMode)
    {
        $this->status = $status;
        $this->editMode = $editMode;
    }

    public function render()
    {
        return view('livewire.statuses.status-form');
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
        $this->validate();
        $this->status->save();
        $this->notification()->success(
             $this->editMode
                ? "Zaktualizowano status"
                : "Dodano Status",
            $this->editMode
                ? "Udało się zaktualizować  status"
                : "Udało się stworzyć nowy status"
        );
        $this->editMode = true;
    }

}
