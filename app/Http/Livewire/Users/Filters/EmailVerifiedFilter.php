<?php

declare(strict_types=1);

namespace App\Http\Livewire\Users\Filters;

use Illuminate\Database\Eloquent\Builder;
use LaravelViews\Filters\Filter;
use Spatie\Permission\Models\Role;

class EmailVerifiedFilter extends Filter
{
    public $title = '';

    public function __construct()
    {
        parent::__construct();
        $this->title = 'Zweryfikowane emaile';
    }

    public function apply(Builder $query, $value, $request): Builder
    {
        if ($value == 1) {
            return $query->whereNotNull('email_verified_at');
        }

        return $query->whereNull('email_verified_at');
    }

    public function options(): array
    {
       return [
           'Tak' => 1,
           'Nie' => 0,
       ];
    }

}
