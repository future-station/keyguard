<?php

namespace FutureStation\KeyGuard\Helpers;

class ArrayHelper
{
    public static function arrayFlatten(array $array): array
    {
        $result = [];
        array_walk_recursive($array, function ($a) use (&$result) {
            $result[] = $a;
        });
        return $result;
    }
}
