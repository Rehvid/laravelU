<?php

declare(strict_types=1);

namespace App\Http\Livewire\Teams;

use App\Models\Team;

use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
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

    public function mount(Team $team, Bool $editMode): void
    {
        $this->team = $team;
        $this->editMode = $editMode;
    }

    public function render(): View
    {
        return view('livewire.teams.team_form');
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
            $this->authorize('update', $this->team);
        } else {
            $this->authorize('create', Team::class);
        }

        $this->validate();

        $this->team->save();

        $this->notification()->success(
             $this->editMode
                ? "Zaktualizowano zespół"
                : "Dodano zespół",
            $this->editMode
                ? "Udało się zaktualizować zespół"
                : "Udało się stworzyć nowy zespół"
        );

        $this->editMode = true;
    }

}
