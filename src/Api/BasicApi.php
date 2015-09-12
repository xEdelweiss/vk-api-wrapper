<?php

namespace VkApi\Api;

use VkApi\Connection;
use VkApi\Utils;

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
     * @param array $ensureIsArray
     * @param array $keyMap
     * @return array
     */
    protected function prepareParametersFromArguments($ensureIsArray = [], $keyMap = [])
    {
        $call = debug_backtrace(false)[1];
        $class = $call['class'];
        $method = $call['function'];
        $arguments = $call['args'];
        $reflection = new \ReflectionMethod($class, $method);
        $reflectionParameters = $reflection->getParameters();

        $parameters = [];

        foreach ($reflectionParameters as $id => $reflectionParameter)
        {
            $originalKey = $reflectionParameter->getName();
            $key = strtolower(preg_replace(
                '/([a-z])([A-Z])/',
                '$1_$2',
                Utils::getFrom($keyMap, $originalKey, $originalKey)
            ));

            // will fail on required values
            // but without them you cannot get here
            $parameters[$key] = isset($arguments[$id])
                ? $arguments[$id]
                : $reflectionParameter->getDefaultValue();

            if (in_array($originalKey, $ensureIsArray)) {
                $parameters[$key] = $this->ensureIsArray($parameters[$key]);
            }
        }

        return $this->prepareParameters($parameters);
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

    /**
     * @param $parameters
     * @return \VkApi\Request\BasicRequest
     */
    protected function createRequest($parameters)
    {
        $method = debug_backtrace(false)[1]['function'];
        return $this->getConnection()->createRequest($this->getFullMethodName($method), $parameters);
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