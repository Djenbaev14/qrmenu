<?php

namespace App\Http\Helpers;

class ApiResponse
{
    public static function success($data, $message = 'Success', $status = 200)
    {
        return response()->json([
            'status' => 'success',
            'data' => $data,
            'message' => $message,
        ], $status);
    }

    public static function error($message, $status = 400, $data = null)
    {
        return response()->json([
            'status' => 'error',
            'data' => $data,
            'message' => $message,
        ], $status);
    }
}