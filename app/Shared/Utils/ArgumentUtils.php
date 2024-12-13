<?php

namespace App\Shared\Utils;

class ArgumentUtils
{
    public static function validateAllByPredicate(array $args, callable $callback): bool {

        if(empty($totalArgs)) return false;

        $totalArgs = count($args);
        $totalArgsValidated = count(array_filter($args, $callback));

        return $totalArgs === $totalArgsValidated;
    }

}
