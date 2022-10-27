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

    // OLD Implementation
    // function happyFunction() {
    //     dump(1);
    //     yield "One";
    //     dump(2);
        
    //     dump(3);
    //     yield "Two";
    //     dump(4);
        
    //     dump(5);
    //     yield "Three";
    //     dump(6);
    // }

    // New Implementation
    function happyFunction($strings) {
        foreach ($strings as $string) {
            dump('start');
            yield $string;
            dump('end');
        }
    }


    // See the returning object and it works only with yield
    // return get_class(happyFunction());
    // return get_class_methods(happyFunction());
    // $return = happyFunction(['One', 'Two', 'Three']);
    
    // OLD Implementation
    // dump($return->current());
    // $return->next();
    // dump($return->current());
    // $return->next();
    // dump($return->current());
    // $return->next();
    // dump($return->current());
    
    // New Implementation
    foreach(happyFunction(['One', 'Two', 'Three']) as $result) {
        dump($result);
    }

    // return happyFunction("Super Happy");
});