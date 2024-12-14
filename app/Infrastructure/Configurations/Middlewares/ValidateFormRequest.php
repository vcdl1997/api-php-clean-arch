<?php

namespace App\Infrastructure\Configurations\Middlewares;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\App;
use ReflectionMethod;

class ValidateFormRequest
{
    public function handle(Request $request, Closure $next)
    {
        $formRequestClass = $this->getFormRequestClassName($request);

        if ($formRequestClass) {
            $formRequest = App::make($formRequestClass);
            $formRequest->validateResolved();
        }

        return $next($request);
    }

    private function getFormRequestClassName(Request $request): string|null
    {
        $action = $request->route()->getActionName();

        list($controller, $method) = explode('@', $action);

        $reflection = new ReflectionMethod($controller, $method);

        foreach ($reflection->getParameters() as $parameter) {
            $type = $parameter->getType();
            $name = $type->getName();

            if ($type && str_contains($name, 'VO') && class_exists($name) && new $name() instanceof FormRequest) {
                return $name;
            }
        }

        return null;
    }
}

