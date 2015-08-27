<?php

namespace VkApi;

class Utils
{
    /**
     * @param $object
     * @return array
     */
    public static function convertToArray($object)
    {
        return json_decode(json_encode($object), true);
    }

    /**
     * @param $array
     * @return object
     */
    public static function convertToObject(array $array)
    {
        return json_decode(json_encode($array), false);
    }

    /**
     * @param $objects
     * @return object
     */
    public static function mergeObjects(...$objects)
    {
        $arrays = array_map('static::convertToArray', $objects);
        $array = call_user_func_array('array_merge', $arrays);
        return static::convertToObject($array);
    }

    /**
     * @param array|object $array
     * @param string $key
     * @param mixed|null $default
     * @return mixed
     */
    public static function getFrom($array, $key, $default = null)
    {
        return isset($array[$key]) ? $array[$key] : $default;
    }

    /**
     * @param ...$items
     * @return mixed
     */
    public static function getNotNull(...$items)
    {
        foreach ($items as $item) {
            if (!is_null($item)) {
                return $item;
            }
        }
    }
}