<?php

namespace App\Shared\Utils;

class ArrayUtils
{
    public static function filterByKeys(array $data, array $keysToExtract): array {
        return array_filter($data, function($key) use ($keysToExtract) {
            return in_array($key, $keysToExtract);
        }, ARRAY_FILTER_USE_KEY);
    }

    public static function bothEqual(array $array1, array $array2): bool {
        return empty(array_diff($array1,$array2)) && empty(array_diff($array2,$array1));
    }

}
