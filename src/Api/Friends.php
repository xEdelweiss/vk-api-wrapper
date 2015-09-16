<?php

namespace VkApi\Api;

use Exception;
use VkApi\Enum\FriendsOrder;
use VkApi\Enum\NameCase;
use VkApi\Enum\UserField;
use VkApi\Exception\Api\TooManyRequestsException;
use VkApi\Exception\NotImplementedException;
use VkApi\Response\BasicResponse;
use VkApi\Response\UsersListResponse;

/**
 * Class Friends
 * @package VkApi\Api
 */
class Friends extends BasicApi
{
    /**
     * Returns a detailed information about a user's friends.
     *
     * @param integer|null  $userId    User ID. By default, the current user ID.
     * @param string|null   $order     @see \VkApi\Enum\FriendsOrder
     * @param array|null    $fields    @see \VkApi\Enum\UserField
     * @param string|null   $nameCase  @see \VkApi\Enum\NameCase
     * @param integer|null  $count     Number of messages to return.
     * @param integer|null  $offset    Offset needed to return a specific subset of messages.
     * @param integer|null  $listId    ID of the friend list returned by the friends.getLists method to be used as the source. This parameter is taken into account only when the uid parameter is set to the current user ID.
     *
     * @return UsersListResponse
     *
     * @throws NotImplementedException
     * @throws Exception
     * @throws TooManyRequestsException
     */
    public function get($userId = null, $order = FriendsOrder::NAME, $fields = [UserField::BDATE], $nameCase = NameCase::NOMINATIVE, $count = null, $offset = null, $listId = null)
    {
        if (is_null($fields)) {
            throw new NotImplementedException('Request without fields is not implemented');
        }

        $parameters = $this->prepareParametersFromArguments(['fields']);
        $request = $this->createRequest($parameters);

        return $request->make(UsersListResponse::class);
    }

    /**
     * Returns a list of user IDs of a user's friends who are online.
     *
     * @param integer|null  $userId        User ID.
     * @param string|null   $order         Sort order. @see \VkApi\Enum\FriendsOrder
     * @param integer|null  $count         Number of messages to return.
     * @param integer|null  $offset        Offset needed to return a specific subset of messages.
     * @param bool|null     $onlineMobile  Return additional online_mobile field.
     * @param integer|null  $listId        Friend list ID. If this parameter is not set, information about all online friends is returned.
     *
     * @return integer[]
     *
     * @throws NotImplementedException
     * @throws Exception
     * @throws TooManyRequestsException
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