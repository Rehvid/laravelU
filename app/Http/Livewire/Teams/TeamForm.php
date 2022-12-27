<?php

namespace App\Http\Livewire\Teams;

use App\Models\Team;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use WireUi\Traits\Actions;

class TeamForm extends Component
{
    use Actions;
    use AuthorizesRequests;

    public Team $team;
    public Bool $editMode;


    public function rules(): array
    {
        return [
            'team.name' => [
                'required',
                'string',
                'min:2',
                'max:100',
                'unique:teams,name' .
                    ($this->editMode ? (',' . $this->team->id) : ''),
            ],
        ];
    }

    public function validationAttributes(): array
    {
        return [
            'name' => 'nazwa'
        ];
    }

    public function mount(Team $team, Bool $editMode)
    {
        $this->team = $team;
        $this->editMode = $editMode;
    }

    public function render()
    {
        return view('livewire.teams.team_form');
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
            $this->authorize('update', $this->team);
        } else {
            $this->authorize('create', Team::class);
        }

        $this->validate();

        $this->team->save();

        $this->notification()->success(
             $this->editMode
                ? "Zaktualizowano team"
                : "Dodano team",
            $this->editMode
                ? "Udało się zaktualizować  team"
                : "Udało się stworzyć nowy team"
        );

        $this->editMode = true;
    }

}
