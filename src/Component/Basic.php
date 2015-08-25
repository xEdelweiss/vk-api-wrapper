<?php

namespace VkApi\Component;

use VkApi\Wrapper;

abstract class Basic
{
    static $prefix;

    /**
     * @var Wrapper
     */
    private $wrapper;

    public function __construct(Wrapper $wrapper)
    {
        $this->wrapper = $wrapper;
    }

    /**
     * @return Wrapper
     */
    protected function wrapper()
    {
        return $this->wrapper;
    }

    protected function method($method)
    {
        return static::$prefix . '.' . $method;
    }
}