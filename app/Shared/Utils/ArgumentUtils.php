<?php

namespace App\Shared\Utils;

class ArgumentUtils
{
    public static function validateAllByPredicate(array $args, callable $callback): bool {
        $totalArgs = count($args);

        if(empty($totalArgs)) return false;

        $totalArgsValidated = count(array_filter($args, $callback));

        return $totalArgs === $totalArgsValidated;
    }

}
