<?php

namespace VkApi\Api;

use VkApi\Response\UsersListResponse;

class Users extends BasicApi
{
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

        $request = $this->createRequest($parameters);

        return $request->make(UsersListResponse::class);
    }
}