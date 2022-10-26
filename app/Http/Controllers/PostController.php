<?php

namespace App\Http\Controllers;

use App\Services\PostService;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = PostService::list();

        return view('posts.index', compact('posts'));
    }
}
