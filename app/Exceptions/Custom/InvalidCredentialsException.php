<?php

namespace App\Exceptions\Custom;

use Exception;

class InvalidCredentialsException extends Exception
{
    public function render($request)
    {
        return response()->json([
            'status' => false,
            'message' => 'Invalid Credentials',
            'error' => 'The provided credentials are incorrect.'
        ], 401);
    }
}
