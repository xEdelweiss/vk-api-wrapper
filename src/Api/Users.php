<?php

namespace VkApi\Api;

use Exception;
use VkApi\Enum\NameCase;
use VkApi\Enum\Radius;
use VkApi\Exception\Api\TooManyRequestsException;
use VkApi\Query\UserSearchQuery;
use VkApi\Response\BasicResponse;
use VkApi\Response\UsersListResponse;

/**
 * Class Users
 * @package VkApi\Api
 */
class Users extends BasicApi
{
    /**
     * Returns detailed information on users.
     *
     * @param array|null $userIds User IDs or screen names (screen_name). By default, current user ID.
     * @param array|null $fields Profile fields to return.
     * @param string|null $nameCase Case for declension of user name and surname.
     *
     * @return UsersListResponse
     */
    public function get($userIds = null, $fields = null, $nameCase = NameCase::NOMINATIVE)
    {
        // поля counters, military будут возвращены только в случае, если передан ровно один user_id
        $parameters = $this->prepareParametersFromArguments();
        $request = $this->createRequest($parameters);

        return $request->make(UsersListResponse::class);
    }

    /**
     * Returns a list of users matching the search criteria.
     *
     * @param UserSearchQuery $query
     * @return UsersListResponse
     */
    public function search(UserSearchQuery $query)
    {
        $parameters = $query->getQueryParameters();
        $request = $this->createRequest($parameters);

        return $request->make(UsersListResponse::class);
    }

    /**
     * Returns information whether a user installed the application.
     *
     * @param integer|null $userId
     *
     * @return bool
     *
     * @throws Exception
     * @throws TooManyRequestsException
     */
    public function isAppUser($userId = null)
    {
        $parameters = $this->prepareParametersFromArguments();
        $request = $this->createRequest($parameters);

        $response = $request->make();

        return (bool) $response->getParsedResponse()->response;
    }

    /**
     * Returns a list of IDs of users and communities followed by the user.
     *
     * @param integer|null $userId
     * @param bool|null $extended
     * @param integer|null $count
     * @param integer|null $offset
     * @param array|null $fields
     *
     * @return BasicResponse
     *
     * @throws Exception
     * @throws TooManyRequestsException
     */
    public function getSubscriptions($userId = null, $extended = true, $count = null, $offset = null, $fields = null)
    {
        $parameters = $this->prepareParametersFromArguments(['fields']);
        $request = $this->createRequest($parameters);

        // TODO implement response for this call
        return $request->make();
    }

    /**
     * Returns a list of followers of the user in question, sorted by date added, most recent first.
     *
     * @param integer|null $userId
     * @param array|null $fields
     * @param string|null $nameCase
     * @param integer|null $count
     * @param integer|null $offset
     *
     * @return UsersListResponse
     *
     * @throws Exception
     * @throws TooManyRequestsException
     */
    public function getFollowers($userId = null, $fields = null, $nameCase = NameCase::NOMINATIVE, $count = null, $offset = null)
    {
        $parameters = $this->prepareParametersFromArguments('fields');
        $request = $this->createRequest($parameters);

        return $request->make(UsersListResponse::class);
    }

    /**
     * Indexes user's current location and returns a list of users who are near.
     *
     * @param float $latitude
     * @param float $longitude
     * @param integer $accuracy
     * @param integer $radius
     * @param array|null $fields
     * @param string|null $nameCase
     * @param integer|null $timeout
     *
     * @return UsersListResponse
     *
     * @throws Exception
     * @throws TooManyRequestsException
     */
    public function getNearby($latitude, $longitude, $accuracy, $radius = Radius::METERS_300, $fields = null, $nameCase = NameCase::NOMINATIVE, $timeout = null)
    {
        $parameters = $this->prepareParametersFromArguments(['fields']);
        $request = $this->createRequest($parameters);

        // TODO implement response for this call
        return $request->make(UsersListResponse::class);
    }

    /**
     * Reports (submits a complain about) a user.
     *
     * @param integer $userId
     * @param string $type
     * @param string|null $comment
     *
     * @return BasicResponse
     *
     * @throws Exception
     * @throws TooManyRequestsException
     */
    public function report($userId, $type, $comment = null)
    {
        $parameters = $this->prepareParametersFromArguments();
        $request = $this->createRequest($parameters);

        // TODO implement action response for this call
        return $request->make();
    }
}