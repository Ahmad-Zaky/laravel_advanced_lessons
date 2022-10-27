<?php

use App\Facades\Postcard;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PostController;
use App\Services\PostcardSendingService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\LazyCollection;
use Illuminate\Support\Str;

Route::get('/', function () {
    return view('welcome');
});

Route::get('customers', [CustomerController::class, 'index']);
Route::get('customers/{customer}', [CustomerController::class, 'show']);

Route::get('posts', [PostController::class, 'index']);

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


Route::get('lazy', function () {
    // Eager Loading Collection
    // $collection = Collection::times(10000000)
    // ->map(function ($number) {
    //     return pow(2, $number);
    // })->all();

    
    // Lazy Loading Collection
    $collection = LazyCollection::times(10000000)
    ->map(function ($number) {
        return pow(2, $number);
    })->all();

    return 'DONE !!!';
});

Route::get('generator', function () {
    // OLD
    // function happyFunction($string) {
    //     return $string;
    // }


    function notHappyFunction($number) {
        $return = [];

        for ($i=0; $i<$number; $i++) {
            $return[] = $i;
        }

        return $return;
    }

    function happyFunction($number) {
        for ($i=0; $i<$number; $i++) {
            yield $i;
        }
    }

    foreach(happyFunction(10000000) as $number) {
        if ($number % 100000 === 0) {
            dump($number);
        }
    }
});