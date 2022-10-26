<?php

namespace App\QueryFilters;

class Active extends Filter
{
    protected function applyFilter($builder)
    {
        $filterName = $this->filterName();

        return $builder->where('active', request($filterName));
    }
}