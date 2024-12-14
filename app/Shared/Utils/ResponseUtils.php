<?php

namespace App\Shared\Utils;

use App\Shared\Enums\HttpHeadersEnum;
use App\Shared\Enums\HttpStatusEnum;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Collection;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;
use Throwable;

class ResponseUtils
{
    public static function unprocessableEntity(ValidationException $exception): JsonResponse{
        return Response::json([
            'errors' => self::formatValidationErrors($exception),
            'timestamp' => now()->format('Y-m-d H:i:s.u'),
            'traceId' => request()->header(HttpHeadersEnum::X_TRACE_ID)
        ],  HttpStatusEnum::UNPROCESSABLE_ENTITY);
    }

    private static function formatValidationErrors(ValidationException $exception): Collection {
        return collect($exception->errors())->map(function ($message, $field) {
            return ['field' =>  $field, 'message' => current($message)];
        })->values();
    }

    public static function error(Throwable $exception, int $statusCode): JsonResponse{
        return Response::json([
            'message' => $exception->getMessage(),
            'timestamp' => now()->format('Y-m-d H:i:s.u'),
            'traceId' => request()->header(HttpHeadersEnum::X_TRACE_ID)
        ], status: $statusCode);
    }

    public static function created(object $resource, string $uri): JsonResponse{
        return Response::json($resource, HttpStatusEnum::CREATED, ["Location" => route($uri, self::extractId($resource))]);
    }

    private static function extractId(object $resource): int|null{
        $data = collect($resource)->toArray();
        return data_get($data,"id");
    }
}
