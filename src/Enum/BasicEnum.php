<?php

namespace VkApi\Enum;

class BasicEnum
{
    /**
     * Return possible values
     *
     * @return array
     */
    public static function all()
    {
        $reflection = new \ReflectionClass(static::class);

        return $reflection->getConstants();
    }
}