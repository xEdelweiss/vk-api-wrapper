<?php

namespace VkApi\Component;

use VkApi\Entity\User;
use VkApi\Enum\UserField;
use VkApi\Response\UsersListResponse;

class Users extends BasicComponent
{
    static $prefix = 'users';

    /**
     * @param array $userIds
     * @param null $fields
     * @param null $nameCase
     * @return UsersListResponse
     */
    public function get($userIds = null, $fields = null, $nameCase = null)
    {
        $parameters = $this->prepareParameters([
            'user_ids' => implode(',', $this->ensureIsArray($userIds)),
            'fields' => implode(',', $this->ensureIsArray($fields)),
            'name_case' => $nameCase
        ]);

        $request = $this->getConnection()->createRequest($this->getFullMethodName('get'), $parameters);

        return $request->make(UsersListResponse::class);
    }

    /**
     * @param $id
     * @param array $fields
     * @param string $nameCase
     * @return User
     */
    public function getUser($id = null, $fields = null, $nameCase = null)
    {
        $response = $this->get($id, $fields, $nameCase);

        return $response->getItems()[0]; // TODO check that first item exists
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