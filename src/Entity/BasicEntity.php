<?php

namespace VkApi\Entity;

use VkApi\Connection;

class BasicEntity
{
    private $data;

    /**
     * @var Connection
     */
    private $connection;

    /**
     * BasicEntity constructor.
     * @param $data
     * @param Connection $connection
     */
    public function __construct($data, Connection $connection)
    {
        $this->data = $data;
        $this->connection = $connection;
    }

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

    public function toArray()
    {
        return $this->convertToArray($this->getRawData());
    }

    public function __debugInfo()
    {
        return $this->toArray();
    }

    private function convertToArray($object)
    {
        return json_decode(json_encode($object), true);
    }
}