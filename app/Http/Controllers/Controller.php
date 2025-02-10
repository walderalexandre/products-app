<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Throwable;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function successResponse($data, int $code = 200): JsonResponse
    {
        return response()->json(['data' => $data], $code);
    }

    protected function errorResponse(string $message, int $code = 500): JsonResponse
    {
        return response()->json(['message' => $message], $code);
    }

    protected function notFoundResponse(string $message): JsonResponse
    {
        return $this->errorResponse($message, 404);
    }

    protected function logError(Throwable $e): void
    {
        \Log::error($e);
    }
}
