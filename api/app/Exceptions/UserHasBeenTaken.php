<?php

namespace App\Exceptions;

use Exception;

class UserHasBeenTaken extends Exception
{
    protected $message = 'User has Been taken.';

    public function render()
    {
        return response()->json([
            'error' => class_basename($this),
            'message' => $this->getMessage(),
        ], 400);
    }
}
