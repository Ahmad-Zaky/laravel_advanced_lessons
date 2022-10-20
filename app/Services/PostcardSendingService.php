<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;

class PostcardSendingService
{
    private $counatry;
    private $width;
    private $height;

    function __construct($counatry, $width, $height)
    {
        $this->counatry = $counatry;
        $this->width = $width;
        $this->height = $height;       
    }

    public function hello($message, $email)
    {
        Mail::raw($message, function ($message) use ($email) {
            $message->to($email);
        });

        // Mail out postcard through some service
        $this->counatry;
        $this->width;
        $this->height;
        
        return "Postcard was sent with the message: {$message}";
    }
}
