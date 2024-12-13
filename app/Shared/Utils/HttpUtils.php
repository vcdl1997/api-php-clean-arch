<?php

namespace App\Shared\Utils;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class HttpUtils
{
    public static function addParamsToUrl($routeName, array $pathParams = [], array $queryParams = []) {
        return Str::finish(url(route($routeName), $pathParams), '?') . Arr::query($queryParams);
    }

}
