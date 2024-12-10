<?php

namespace App\Shared\Utils;

use App\Shared\Enums\HttpStatusEnum;
use App\Shared\Exceptions\BadRequestException;
use App\Shared\Exceptions\NotFoundException;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class ResponseUtils
{
    public static function unprocessableEntity(ValidationException $exception): JsonResponse{
        $errors = collect($exception->errors())->map(function ($message, $error) {
            return ['field' =>  $error, 'message' => $message[0]];
        });

        return response()->json([
            'errors' => $errors,
            'timestamp' => now('America/Sao_Paulo')->format('Y-m-d H:i:s')
        ],  HttpStatusEnum::UNPROCESSABLE_ENTITY);
    }

    public static function error(Exception $exception, int $statusCode): JsonResponse{
        return response()->json([
            'message' => $exception->getMessage(),
            'timestamp' => now('America/Sao_Paulo')->format('Y-m-d H:i:s')
        ], status: $statusCode);
    }

}
