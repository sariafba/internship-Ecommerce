<?php

namespace App\Exceptions;

use Exception;

class UnverifiedEmailException extends BaseException
{
    public function report()
    {
        //
    }

    public function render()
    {
        return response()->json([
            'error' => __("custom.Unverified Email")
        ], 401);
    }
}
