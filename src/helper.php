<?php
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
        return array_has($array, [$key])?$array[$key]:$default;
    }
}
