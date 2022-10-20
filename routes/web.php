<?php

use App\Facades\Postcard;
use App\Services\PostcardSendingService;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/nofacades/postcards', function () {
    $postcardService = new PostcardSendingService("us", 4, 6);

    $postcard = $postcardService->hello("Hello from Ahmed Zaky in Egypt", "me@email.com");

    return response()->json(["message" => $postcard]);
});

Route::get('/facades/postcards', function () {
    
    $postcard = Postcard::hello("Hello from Ahmed Zaky in Egypt", "me@email.com");
    
    return response()->json(["message" => $postcard]);
});

