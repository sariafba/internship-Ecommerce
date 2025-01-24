<?php

namespace App\Exceptions;

use Exception;

class WrongPasswordException extends BaseException
{
    public function report()
    {
        //
    }

    public function render()
    {
        return response()->json([
            'error' => __("custom.Wrong Password")
        ], 401);
    }
}
