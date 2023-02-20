<?php

namespace App\Http\Responses;

use Illuminate\Http\Response;

class APIResponse
{
    public static function success($message, $data = null, $statusCode = Response::HTTP_OK)
    {
        $response = [
            'success' => true,
            'message' => $message,
        ];

        if (!is_null($data)) {
            $response['data'] = $data;
        }

        return response()->json($response, $statusCode);
    }

    public static function created($message, $data = null)
    {
        return self::success($message, $data, Response::HTTP_CREATED);
    }

    public static function deleted($message)
    {
        return self::success($message, null, Response::HTTP_NO_CONTENT);
    }

    public static function error($message, $statusCode = Response::HTTP_BAD_REQUEST)
    {
        return response()->json([
            'success' => false,
            'message' => $message
        ], $statusCode);
    }

    public static function unauthorized($message = 'Unauthorized')
    {
        return self::error($message, Response::HTTP_UNAUTHORIZED);
    }

    public static function forbidden($message = 'Forbidden')
    {
        return self::error($message, Response::HTTP_FORBIDDEN);
    }

    public static function notFound($message = 'Not Found')
    {
        return self::error($message, Response::HTTP_NOT_FOUND);
    }

    public static function validationError($errors)
    {
        return response()->json([
            'success' => false,
            'message' => 'Validation error',
            'errors' => $errors
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}