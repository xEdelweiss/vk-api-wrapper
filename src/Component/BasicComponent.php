<?php

namespace VkApi\Component;

use VkApi\Connection;

abstract class BasicComponent
{
    static $prefix;

    /**
     * @var Connection
     */
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param array $parameters
     * @return array
     */
    protected function prepareParameters(array $parameters)
    {
        return array_filter($parameters);
    }

    /**
     * @return Connection
     */
    protected function getConnection()
    {
        return $this->connection;
    }

    protected function getFullMethodName($method)
    {
        return static::$prefix . '.' . $method;
    }

    /**
     * @param $array
     * @return array
     *
     * TODO objects?
     */
    protected function ensureIsArray($array)
    {
        if (is_null($array)) {
            return [];
        }

        if (is_scalar($array)) {
            return [$array];
        }

        return $array;
    }
}