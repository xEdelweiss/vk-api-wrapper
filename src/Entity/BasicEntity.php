<?php

namespace VkApi\Entity;

use VkApi\Connection;
use VkApi\Utils;

class BasicEntity
{
    /**
     * JSON Decoded response from VK
     *
     * @var object
     */
    private $data;

    /**
     * @var Connection
     */
    private $connection;

    /**
     * Required to make extended entity requests with same parameters
     *
     * @var array
     */
    private $originalRequestParameters;

    /**
     * BasicEntity constructor.
     * @param object $data
     * @param array $originalRequestParameters
     * @param Connection $connection
     */
    public function __construct($data, $originalRequestParameters, Connection $connection)
    {
        $this->data = $data;
        $this->connection = $connection;
        $this->originalRequestParameters = $originalRequestParameters;
    }

    /**
     * @return object
     */
    public function getRawData()
    {
        return $this->data;
    }

    /**
     * @return Connection
     */
    public function getConnection()
    {
        return $this->connection;
    }

    /**
     * @return mixed
     */
    public function getOriginalRequestParameters()
    {
        return $this->originalRequestParameters;
    }

    /**
     * @param $key
     * @param null $default
     * @return mixed
     */
    public function getOriginalRequestParameter($key, $default = null)
    {
        $originalParameters = $this->getOriginalRequestParameters();

        return Utils::getFrom($originalParameters, $key, $default);
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return Utils::convertToArray($this->getRawData());
    }

    /**
     * @return array
     */
    public function __debugInfo()
    {
        return $this->toArray();
    }

    /**
     * @param $key
     * @param null $default
     * @param bool $requestExtended
     * @return mixed
     */
    public function getRawValue($key, $requestExtended = true, $default = null)
    {
        if (!isset($this->getRawData()->{$key})) {
            if (!$requestExtended) {
                return $default;
            }

            $extendedEntity = $this->requestExtendedRawData();

            if (is_null($extendedEntity) || !isset($extendedEntity->getRawData()->{$key})) {
                return $default;
            }

            $this->mergeWith($extendedEntity);
        }

        return $this->getRawData()->{$key};
    }

    /**
     * Returns current Entity "clone" with extended info
     *
     * @return static
     */
    protected function requestExtendedRawData()
    {
        // make extended request in child and return Entity
        return null;
    }

    /**
     * @param BasicEntity $extendedEntity
     */
    protected function mergeWith(BasicEntity $extendedEntity = null)
    {
        if (is_null($extendedEntity)) {
            return;
        }

        $this->data = Utils::mergeObjects($this->data, $extendedEntity->getRawData());;
    }
}