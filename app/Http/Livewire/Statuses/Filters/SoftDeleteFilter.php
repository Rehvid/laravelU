<?php

namespace App\Http\Livewire\Statuses\Filters;

use Illuminate\Database\Eloquent\Builder;
use LaravelViews\Filters\Filter;

class SoftDeleteFilter extends Filter
{
    public  $title = '';

    public function __construct()
    {
        parent::__construct();
        $this->title = 'Usunięto';
    }

    public function apply(Builder $query, $value, $request): Builder
    {
        if ($value == 1) {
            return $query->whereNotNull('deleted_at');
        }
        return $query->whereNull('deleted_at');
    }

    public function options(): array
    {
        return [
            'tak' => 1,
            'nie' => 0
        ];
    }
}
