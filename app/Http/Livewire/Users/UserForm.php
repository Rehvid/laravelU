<?php

declare(strict_types=1);

namespace App\Http\Livewire\Users;

use App\Models\Team;

use App\Models\User;
use App\Models\Status;
use Livewire\Component;
use WireUi\Traits\Actions;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserForm extends Component
{
    use Actions;
    use AuthorizesRequests;

    public User $user;
    public Bool $editMode;


    public function rules(): array
    {
        return [
            'user.team_id' => [
                'required',
                'numeric',
            ],
        ];
    }

    public function validationAttributes(): array
    {
        return [
            'name' => 'nazwa'
        ];
    }

    public function mount(User $user, Bool $editMode): void
    {
        $this->user = $user;
        $this->editMode = $editMode;
    }

    public function render(): View
    {
        return view('livewire.users.user-form', [
            'teams' => $this->getTeams()
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
        $this->authorize('assignTeam', User::class);

        $this->validate();

        $this->user->save();

        $this->notification()->success(
           'Przypisanie do zespołu',
           'Udało się przepisać do zespołu'
        );

        $this->editMode = true;
    }

    private function getTeams (): array
    {

        if (Auth::user()->isAdmin()) {
            $teams = Team::select('id', 'name')->get();
        } else if (Auth::user()->isManager()) {
            $teams = Team::select('id', 'name')->get()->where('id', '=', Auth::user()->team_id);
        }

        $teamsOptions = [];

        foreach($teams as ['id' => $id, 'name' => $name]) {
            $teamsOptions[$id] = $name;
        }

        return $teamsOptions;
    }

}
