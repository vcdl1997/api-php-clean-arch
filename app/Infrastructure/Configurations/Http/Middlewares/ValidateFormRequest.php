<?php

namespace App\Infrastructure\Configurations\Http\Middlewares;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\App;
use ReflectionMethod;

class ValidateFormRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Verifica se o controller da requisição foi de fato um FormRequest
        $formRequestClass = $this->getFormRequestClass($request);

        if ($formRequestClass) {
            $formRequest = App::make($formRequestClass);
            $formRequest->validateResolved();
        }

        return $next($request);
    }

    /**
     * Obter a classe FormRequest associada à requisição.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function getFormRequestClass(Request $request): FormRequest|null
    {
        $action = $request->route()->getActionName();
        list($controller, $method) = explode('@', $action);

        $reflection = new ReflectionMethod($controller, $method);

        foreach ($reflection->getParameters() as $parameter) {
            $type = $parameter->getType();
            $name = $type->getName();

            if ($type && str_contains($name, 'VO') && class_exists($type->getName() && new $name() instanceof FormRequest)) {
                return new $name();
            }
        }

        return null;
    }
}

