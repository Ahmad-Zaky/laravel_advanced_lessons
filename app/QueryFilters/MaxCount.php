<?php

namespace App\QueryFilters;

class MaxCount extends Filter
{
    protected function applyFilter($builder)
    {
        $filterName = $this->filterName();

        return is_numeric(request($filterName))
            ? $builder->take(request($filterName))
            : $builder;
    }
}