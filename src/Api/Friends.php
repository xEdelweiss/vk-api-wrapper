<?php

namespace VkApi\Api;

use VkApi\Enum\FriendsOrder;
use VkApi\Enum\NameCase;
use VkApi\Enum\UserField;
use VkApi\Exception\NotImplementedException;
use VkApi\Response\BasicResponse;
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

    /**
     * Возвращает список идентификаторов друзей пользователя, находящихся на сайте.
     *
     * @param integer|null $userId
     * @param string|null $order
     * @param integer|null $count
     * @param integer|null $offset
     * @param bool|false|null $onlineMobile
     * @param integer|null $listId
     * @return integer[]
     * @throws NotImplementedException
     * @throws \Exception
     * @throws \VkApi\Exception\Api\TooManyRequestsException
     */
    public function getOnline($userId = null, $order = FriendsOrder::NAME, $count = null, $offset = null, $onlineMobile = false, $listId = null)
    {
        if ($onlineMobile != false) {
            throw new NotImplementedException('Request with online_mobile=1 is not implemented');
        }

        $parameters = $this->prepareParametersFromArguments();
        $request = $this->createRequest($parameters);

        $response = $request->make(BasicResponse::class);
        return $response->getParsedResponse()->response;
    }

}