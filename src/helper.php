<?php

use Illuminate\Support\Arr;

if (!function_exists('valueExist')) {
    /**
     *
     * @param array $array
     * @param mix $key
     * @param mix $default
     * @return mix
     */
    function valueExist(array $array, $key, $default)
    {
        return Arr::has($array, [$key])?$array[$key]:$default;
    }
}
