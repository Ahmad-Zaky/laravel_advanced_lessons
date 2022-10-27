<?php

namespace App\Repositories\Elequent;

use App\Models\Customer;
use App\Repositories\CustomerRepositoryInterface;

class CustomerRepository  implements CustomerRepositoryInterface
{
    
    public function all() 
    {
        return Customer::orderBy('name')
            ->where('active', request('active') ?? 1)
            ->with('user')
            ->get()
            ->map->format();
    }

    public function find($value, string $col='')
    {
        if (! $col) {
            return Customer::where('id', $value)
                ->where('active', request('active') ?? 1)
                ->with('user')
                ->get()
                ->firstOrFail()
                ->format();
        }

        if (in_array($col, (new Customer)->searchable)) {
            return Customer::where($col, 'like', '%'. $value .'%')
                    ->where('active', request('active') ?? 1)
                    ->with('user')
                    ->get()
                    ->firstOrFail()
                    ->format();
        }

        return false;
    }
}
