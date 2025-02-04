<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponseTrait
{
    function successResponse($data = [], $message = null, $code = 200): JsonResponse
    {
        return response()->json([
            'data' => $data,
            'meta' => [
                'message' => $message ?? 'Action proceed sucessfully'
            ]
        ], $code);
    }

    function failedResponse($data = [], $message = null, $errors = [], $code = 500): JsonResponse {
        return response()->json([
            'data' => $data,
            'meta' => [
                'message' => $message ?? 'Fail to proceed action',
                'errors' => $errors
            ]
        ], $code);
    }
}
