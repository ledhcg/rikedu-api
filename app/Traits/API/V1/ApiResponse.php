<?php

namespace App\Traits\API\V1;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

trait ApiResponse
{
    protected function successResponse($data, $message = null, $status = Response::HTTP_OK): JsonResponse
    {
        return new JsonResponse([
            'success' => true,
            'status_code' => $status,
            'message' => $message,
            'data' => $data,
        ], $status);
    }

    protected function errorResponse($message, $status): JsonResponse
    {
        return new JsonResponse([
            'success' => false,
            'status_code' => $status,
            'message' => $message,
            'data' => null,
        ], $status);
    }

    protected function notFoundResponse($message = 'Resource not found'): JsonResponse
    {
        return $this->errorResponse($message, Response::HTTP_NOT_FOUND);
    }

    protected function unauthorizedResponse($message = 'Unauthorized'): JsonResponse
    {
        return $this->errorResponse($message, Response::HTTP_UNAUTHORIZED);
    }

    protected function validationErrorResponse($message, $errors = null): JsonResponse
    {
        return new JsonResponse([
            'success' => false,
            'status_code' => Response::HTTP_UNPROCESSABLE_ENTITY,
            'message' => $message,
            'data' => $errors,
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    protected function createdResponse($data, $message = 'Resource created successfully'): JsonResponse
    {
        return $this->successResponse($data, $message, Response::HTTP_CREATED);
    }

    protected function updatedResponse($data, $message = 'Resource updated successfully'): JsonResponse
    {
        return $this->successResponse($data, $message, Response::HTTP_OK);
    }

    protected function deletedResponse($message = 'Resource deleted successfully'): JsonResponse
    {
        return $this->successResponse(null, $message, Response::HTTP_NO_CONTENT);
    }

    protected function forbiddenResponse($message = 'Forbidden'): JsonResponse
    {
        return $this->errorResponse($message, Response::HTTP_FORBIDDEN);
    }
}