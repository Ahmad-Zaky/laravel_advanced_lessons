<?php

use App\Facades\Postcard;
use App\Services\PostcardSendingService;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

Route::get('/', function () {
    return view('welcome');
});

Route::get('macros/str/{number}', function (int $number) {
    return [
        'partNumber' => Str::partNumber($number),
        'prefix' => Str::prefix($number, 'ABCD-'),
    ];
});

Route::get('macros/response', function () {
    $message = "A huge error occured BOOM !!!";
    $code = 123;
    
    return Response::errorJson($message, $code);
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

