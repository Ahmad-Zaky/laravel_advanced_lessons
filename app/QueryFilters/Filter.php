<?php

namespace App\QueryFilters;

use Illuminate\Support\Str;
use Closure;

abstract class Filter
{
    public function handle($request, Closure $next)
    {
        $filterName = $this->filterName();
        if (
            ! request()->has($filterName) ||
            ! request($filterName) === "" ||
            request($filterName) === NULL
        ) { return $next($request); }

        $builder = $next($request);

        return $this->applyFilter($builder);
    }

    protected abstract function applyFilter($builder);
    
    protected function filterName()
    {
        return Str::snake(class_basename($this));
    }
    
}
