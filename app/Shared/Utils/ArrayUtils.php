<?php

namespace App\Shared\Utils;

class ArrayUtils
{
    public static function filterByKeys(array $data, array $keysToExtract): array {
        return array_filter($data, function($key) use ($keysToExtract) {
            return in_array($key, $keysToExtract);
        }, ARRAY_FILTER_USE_KEY);
    }

}
