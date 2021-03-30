<?php

namespace App\Traits;

trait ApiResponse
{
    public function jsonResponse($status, $message, $data = null)
    {
        return response()->json([
            'message' => $message,
            'data' => $data
        ], $status);
    }


    public function jsonErrorResponse($status, $message, $errors) {
        return response()->json([
            'message' => $message,
            'errors' => $errors
        ], $status);
    }
}