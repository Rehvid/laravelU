<?php

declare(strict_types=1);

namespace App\Http\Livewire\Statuses;

use App\Models\Status;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use WireUi\Traits\Actions;

class StatusForm extends Component
{
    use Actions;
    use AuthorizesRequests;

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
            'name' => __('table.headers.name')
        ];
    }

    public function mount(Status $status, Bool $editMode): void
    {
        $this->status = $status;
        $this->editMode = $editMode;
    }

    public function render(): View
    {
        return view('livewire.statuses.status-form');
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
            $this->authorize('update', $this->status);
        } else {
            $this->authorize('create', Status::class);
        }

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
