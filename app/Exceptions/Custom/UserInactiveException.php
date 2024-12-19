<?php

namespace App\Exceptions\Custom;

use Exception;

class UserInactiveException extends Exception
{
    public function render($request)
    {
        return response()->json([
            'status' => false,
            'message' => 'Account Inactive',
            'error' => 'Your account is currently inactive. Please contact support.'
        ], 403);
    }
}
