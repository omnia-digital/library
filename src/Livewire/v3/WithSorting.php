<?php

namespace OmniaDigital\OmniaLibrary\Livewire\v3;

use Illuminate\Database\Eloquent\Builder;

trait WithSorting
{
    public string $sortField = 'id';
    public string $sortDirection = 'desc';

    public function defaultSorting($sortField, $sortDirection = 'desc')
    {
        $this->sortField = $sortField;
        $this->sortDirection = $sortDirection;
    }

    public function sortBy($field)
    {
        $this->sortDirection = $this->sortField === $field
            ? $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc'
            : 'asc';

        $this->sortField = $field;
    }

    public function applySorting(Builder $query): Builder
    {
        return $query->orderBy($this->sortField, $this->sortDirection);
    }
}
