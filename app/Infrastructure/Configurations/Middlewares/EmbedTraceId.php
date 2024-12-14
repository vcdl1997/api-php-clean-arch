<?php

namespace App\Infrastructure\Configurations\Middlewares;

use App\Shared\Enums\HttpHeadersEnum;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EmbedTraceId
{
    public function handle(Request $request, Closure $next)
    {
        if(!$request->headers->has(HttpHeadersEnum::X_TRACE_ID)){
            $request->headers->set(HttpHeadersEnum::X_TRACE_ID, Str::uuid()->toString());
        }

        return $next($request);
    }
}

