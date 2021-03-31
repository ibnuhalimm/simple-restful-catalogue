<?php

namespace App\Traits;

trait ApiResponse
{
    public function apiResponse($status, $message, $data = null)
    {
        return response()->json([
            'message' => $message,
            'data' => $data
        ], $status);
    }


    public function apiErrorResponse($status, $message, $errors) {
        return response()->json([
            'message' => $message,
            'errors' => $errors
        ], $status);
    }
}