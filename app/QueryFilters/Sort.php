<?php

namespace App\QueryFilters;

class Sort extends Filter
{
    protected function applyFilter($builder)
    {
        $filterName = $this->filterName();

        return in_array(strtolower(request($filterName)), ['asc', 'desc']) 
            ? $builder->orderBy('title', request($filterName))
            : $builder;
    }
}