<?php

namespace VkApi\Component;

use VkApi\Api\Users as UsersApi;
use VkApi\Api\Messages as MessagesApi;
use VkApi\Api\Database as DatabaseApi;

/**
 * Class Api
 * @package VkApi\Component
 *
 * @property UsersApi $users
 * @property MessagesApi $messages
 * @property DatabaseApi $database
 *
 * FIXME brr
 */
class Api extends BasicComponent
{
    private $instantiated;

    /**
     * @param $name
     * @return mixed
     */
    function __get($name)
    {
        $apiName = ucfirst($name);

        if (!isset($this->instantiated[$apiName])) {
            $className =  '\\VkApi\\Api\\' . $apiName;

            $this->instantiated[$apiName] = new $className($this->getConnection());
        }

        return $this->instantiated[$apiName];
    }
}