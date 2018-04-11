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

if (! function_exists('checkResponseException')) {
    /**
     * check for object is Exception throw Exception Message
     *
     * @param \Exception $object
     * @throws Exception
     */
    function checkResponseException($object)
    {
        if ($object instanceof \Exception) {
            throw new \Exception($object->getMessage());
        }
    }
}
