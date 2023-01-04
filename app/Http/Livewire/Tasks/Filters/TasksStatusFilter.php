<?php

declare(strict_types=1);

namespace App\Http\Livewire\Tasks\Filters;

use App\Models\Status;
use LaravelViews\Filters\Filter;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Builder;

class TasksStatusFilter extends Filter
{
    public $title = '';

    public function __construct()
    {
        parent::__construct();

        $this->title = 'Statusy';
    }

    public function apply(Builder $query, $value, $request): Builder
    {
        return $query->whereHas('status', function(Builder $query) use ($value) {
            $query->where('id', '=', $value);
        });
    }

    public function options(): array
    {
        $roles = Status::all();

        $labels = $roles->pluck('name');
        $values = $roles->pluck('id');

        return $labels->combine($values)->toArray();
    }
}
