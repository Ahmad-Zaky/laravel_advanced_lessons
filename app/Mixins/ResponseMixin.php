<?php

namespace App\Mixins;

class ResponseMixin
{
    public function errorJson() 
    {
        return function (
            string $message = "Default Error Message",
            int $code = 000
        ) {
            return [
                'message' => $message,
                'code' => $code,
            ];
        };
    }
}