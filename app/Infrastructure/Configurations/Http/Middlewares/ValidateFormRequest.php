<?php

namespace App\Infrastructure\Configurations\Http\Middlewares;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\App;
use ReflectionMethod;

class ValidateFormRequest
{
    public function handle(Request $request, Closure $next)
    {
        $formRequestClass = $this->getFormRequestClass($request);

        if () {
            $formRequest = App::make($formRequestClass);
            $formRequest->validateResolved();
        }

        return $next($request);
    }

    private function getFormRequestClass(Request $request): FormRequest|null
    {
        $action = $request->route()->getActionName();

        list($controller, $method) = explode('@', $action);

        $reflection = new ReflectionMethod($controller, $method);

        foreach ($reflection->getParameters() as $parameter) {
            $type = $parameter->getType();
            $name = $type->getName();

            if ($type && str_contains($name, 'VO') && class_exists($type->getName()) && new $name() instanceof FormRequest) {
                return new $name();
            }
        }

        return null;
    }
}

