<?php

namespace App\Exceptions;

use Illuminate\Validation\ValidationException;

class CustomValidationException extends ValidationException
{
    public function render($request): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'message' => 'Validation error.',
            'errors' => $this->validator->errors()->messages(),
        ], 422);
    }
}
