<?php

namespace VkApi\Component;

use VkApi\Entity\User;
use VkApi\Response\UsersListResponse;

class Users extends Basic
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
            'user_ids' => is_null($userIds) ? null : implode(',', $userIds),
            'fields' => is_null($fields) ? null : implode(',', $fields),
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
    public function getById($id, $fields = null, $nameCase = null)
    {
        $response = $this->get([$id], $fields, $nameCase);

        return $response->getItems()[0]; // TODO check that first item exists
    }

}