<?php

namespace VkApi\Api;

use VkApi\Connection;

abstract class BasicApi
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
        $reflection = new \ReflectionClass(static::class);
        return (static::$prefix ?: strtolower($reflection->getShortName())) . '.' . $method;
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