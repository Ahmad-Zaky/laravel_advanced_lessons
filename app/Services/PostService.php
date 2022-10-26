<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Pipeline\Pipeline;

class PostService
{
    public static function list()
    {
        return app(Pipeline::class)
            ->send(Post::query())
            ->through([
                \App\QueryFilters\Active::class,
                \App\QueryFilters\Sort::class,
                \App\QueryFilters\MaxCount::class,
            ])
            ->thenReturn()
            ->paginate();
    }
}