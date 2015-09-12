<?php

namespace VkApi\Component;

use VkApi\Entity\User;
use VkApi\Enum\FriendsOrder;
use VkApi\Enum\NameCase;
use VkApi\Enum\UserField;
use VkApi\Response\UsersListResponse;

class Users extends BasicComponent
{
    static $prefix = 'users';

    /**
     * @param array $userIds
     * @param array|null $fields
     * @param string|null $nameCase
     * @return UsersListResponse
     */
    public function getUsers(array $userIds, $fields = null, $nameCase = NameCase::NOMINATIVE)
    {
        return $this->api->users
            ->get($userIds, $fields, $nameCase);
    }

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

    /**
     * @param null $userId
     * @param string $fields
     * @param null $count
     * @param null $offset
     * @return UsersListResponse
     * @throws \VkApi\Exception\NotImplementedException
     */
    public function getFriends($userId = null, $fields = UserField::BDATE, $count = null, $offset = null)
    {
        return $this->api->friends
            ->get($userId, FriendsOrder::NAME, $fields, NameCase::NOMINATIVE, $count, $offset);
    }

    /**
     * @param integer|null $userId
     * @param array|null $fields
     * @param integer|null $count
     * @param integer|null $offset
     * @param string $order
     * @return UsersListResponse
     * @throws \VkApi\Exception\NotImplementedException
     */
    public function getOnlineFriends($userId = null, $fields = null, $count = null, $offset = null, $order = FriendsOrder::NAME)
    {
        $userIds = $this->api->friends
            ->getOnline($userId, $order, $count, $offset);

        return $this->getConnection()->users->getUsers($userIds, $fields);
    }
}