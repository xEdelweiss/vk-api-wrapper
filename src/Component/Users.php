<?php

namespace VkApi\Component;

use VkApi\Entity\User;
use VkApi\Enum\UserField;
use VkApi\Response\UsersListResponse;

class Users extends BasicComponent
{
    static $prefix = 'users';

    /**
     * @param $id
     * @param array $fields
     * @param string $nameCase
     * @return User
     */
    public function getUser($id = null, $fields = null, $nameCase = null)
    {
        return $this->api->users
            ->get($id, $fields, $nameCase)
            ->getFirstItem();
    }

    /**
     * @param array|null $fields
     * @param string|null $nameCase
     * @return User
     */
    public function getCurrentUser($fields = null, $nameCase = null)
    {
        return $this->getUser(null, $fields, $nameCase);
    }

    /**
     * @param null $id
     * @param null $nameCase
     * @return User
     */
    public function getUserWithFullInfo($id = null, $nameCase = null)
    {
        return $this->getUser($id, UserField::all(), $nameCase);
    }
}