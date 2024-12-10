<?php

namespace App\Application\Controllers\Handlers;

use App\Shared\Enums\HttpStatusEnum;
use App\Shared\Utils\ResponseUtils;
use Illuminate\Foundation\Exceptions\Handler;
use Illuminate\Http\JsonResponse;
use Throwable;

class ControllerExceptionHandler extends Handler
{
    /**
     * Uma lista de exceções que não devem ser relatadas.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * Registre os manipuladores de exceções para a aplicação.
     *
     * @param \Exception $exception
     * @return void
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Renderize a exceção para uma resposta HTTP.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Exception $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Throwable $exception): JsonResponse
    {
        $exceptionClassName = basename($exception::class);

        switch( $exceptionClassName ) {
            case 'BadRequestException':
                return ResponseUtils::error($exception, HttpStatusEnum::BAD_REQUEST);

            case 'NotFoundException':
                return ResponseUtils::error($exception, HttpStatusEnum::NOT_FOUND);

            case 'ValidationException':
                return ResponseUtils::unprocessableEntity($exception);

            default:
                return ResponseUtils::error($exception, HttpStatusEnum::INTERNAL_SERVER_ERROR);
        }
    }
}
