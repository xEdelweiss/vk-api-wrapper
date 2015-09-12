<?php

namespace VkApi\Api;

use VkApi\Enum\FriendsOrder;
use VkApi\Enum\NameCase;
use VkApi\Enum\UserField;
use VkApi\Exception\NotImplementedException;
use VkApi\Response\UsersListResponse;

class Friends extends BasicApi
{
    /**
     * Возвращает список друзей пользователя.
     *
     * @param integer|null $userId
     * @param string|null $order
     * @param array|null $fields
     * @param string|null $nameCase
     * @param integer|null $count
     * @param integer|null $offset
     * @param integer|null $listId
     * @return UsersListResponse
     * @throws NotImplementedException
     * @throws \Exception
     * @throws \VkApi\Exception\Api\TooManyRequestsException
     */
    public function get($userId = null, $order = FriendsOrder::NAME, $fields = [UserField::BDATE], $nameCase = NameCase::NOMINATIVE, $count = null, $offset = null, $listId = null)
    {
        if (is_null($fields)) {
            throw new NotImplementedException('Request without fields is not implemented');
        }

        $parameters = $this->prepareParametersFromArguments();
        $request = $this->createRequest($parameters);

        return $request->make(UsersListResponse::class);
    }

}