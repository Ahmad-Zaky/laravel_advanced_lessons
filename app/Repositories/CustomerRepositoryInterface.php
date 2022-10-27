<?php

namespace App\Repositories;

interface CustomerRepositoryInterface
{
    public function all();

    public function find($value, string $col);
}