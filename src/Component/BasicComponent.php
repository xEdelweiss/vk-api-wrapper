<?php

namespace VkApi\Component;

use VkApi\Connection;

/**
 * Class BasicComponent
 * @package VkApi\Component
 *
 * @property Api $api Low-level Api Component
 * @property Messages $messages Messages Component
 * @property Dialogs $dialogs Dialogs Component
 * @property Users $users Users Component
 * @property Countries $countries Countries Component
 * @property Regions $regions Regions Component
 * @property Cities $cities Cities Component
 */
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
     * FIXME brr
     */
    public function __get($name)
    {
        return $this->getConnection()->{$name};
    }

    /**
     * @return Connection
     */
    protected function getConnection()
    {
        return $this->connection;
    }
}