<?php

namespace App\Shared\Utils;

use App\Shared\Enums\HttpStatusEnum;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Throwable;

class ResponseUtils
{
    public static function created(object $resource, string $uri): JsonResponse{
        return response()->json($resource, HttpStatusEnum::CREATED, ["Location" => route($uri, $resource->id)]);
    }

    public static function unprocessableEntity(ValidationException $exception): JsonResponse{
        $errors = collect($exception->errors())->map(function ($message, $field) {
            return ['field' =>  $field, 'message' => current($message)];
        });

        return response()->json([
            'errors' => $errors,
            'timestamp' => now()->format('Y-m-d H:i:s.u')
        ],  HttpStatusEnum::UNPROCESSABLE_ENTITY);
    }

    public static function error(Throwable $exception, int $statusCode): JsonResponse{
        return response()->json([
            'message' => $exception->getMessage(),
            'timestamp' => now()->format('Y-m-d H:i:s.u')
        ], status: $statusCode);
    }

}
