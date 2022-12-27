<?php

declare(strict_types=1);

namespace App\Http\Livewire\Users\Filters;

use App\Models\Team;
use LaravelViews\Filters\Filter;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Builder;

class UsersTeamFilter extends Filter
{
    public $title = '';

    public function __construct()
    {
        parent::__construct();

        $this->title = 'teams';
    }

    public function apply(Builder $query, $value, $request): Builder
    {
        return $query->whereHas('team', function(Builder $query) use ($value) {
            $query->where('id', '=', $value);
        });
    }

    public function options(): array
    {
        $roles = Team::all();

        $labels = $roles->pluck('name');
        $values = $roles->pluck('id');

        return $labels->combine($values)->toArray();
    }
}
