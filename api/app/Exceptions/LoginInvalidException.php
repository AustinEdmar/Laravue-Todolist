<?php

namespace App\Exceptions;

use Exception;

class LoginInvalidException extends Exception
{
    protected $message = 'Email and Password dont match, senha.';

    public function render()
    {
        return response()->json([
            'error' => class_basename($this),
            'message' => $this->getMessage(),
        ], 401);
    }
}
