<?php

namespace VkApi\Api;

use VkApi\Enum\NameCase;
use VkApi\Enum\Radius;
use VkApi\Query\UserSearchQuery;
use VkApi\Response\BasicResponse;
use VkApi\Response\UsersListResponse;

class Users extends BasicApi
{
    /**
     * Возвращает расширенную информацию о пользователях.
     *
     * @param array|null $userIds
     * @param array|null $fields
     * @param string|null $nameCase
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
     * Возвращает список пользователей в соответствии с заданным критерием поиска.
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
     * Возвращает информацию о том, установил ли пользователь приложение.
     *
     * @param integer|null $userId
     * @return bool
     * @throws \Exception
     * @throws \VkApi\Exception\Api\TooManyRequestsException
     */
    public function isAppUser($userId = null)
    {
        $parameters = $this->prepareParametersFromArguments();
        $request = $this->createRequest($parameters);

        $response = $request->make(BasicResponse::class);

        return (bool) $response->getParsedResponse()->response;
    }

    /**
     * Возвращает список идентификаторов пользователей и сообществ, которые входят в список подписок пользователя.
     *
     * @param integer|null $userId
     * @param bool|null $extended
     * @param integer|null $count
     * @param integer|null $offset
     * @param array|null $fields
     * @return BasicResponse
     * @throws \Exception
     * @throws \VkApi\Exception\Api\TooManyRequestsException
     */
    public function getSubscriptions($userId = null, $extended = true, $count = null, $offset = null, $fields = null)
    {
        $parameters = $this->prepareParametersFromArguments(['fields']);
        $request = $this->createRequest($parameters);

        // TODO implement response for this call
        return $request->make(BasicResponse::class);
    }

    /**
     * Возвращает список идентификаторов пользователей, которые являются подписчиками пользователя.
     * Идентификаторы пользователей в списке отсортированы в порядке убывания времени их добавления.
     *
     * @param integer|null $userId
     * @param array|null $fields
     * @param string|null $nameCase
     * @param integer|null $count
     * @param integer|null $offset
     * @return UsersListResponse
     * @throws \Exception
     * @throws \VkApi\Exception\Api\TooManyRequestsException
     */
    public function getFollowers($userId = null, $fields = null, $nameCase = NameCase::NOMINATIVE, $count = null, $offset = null)
    {
        $parameters = $this->prepareParametersFromArguments('fields');
        $request = $this->createRequest($parameters);

        return $request->make(UsersListResponse::class);
    }

    /**
     * Индексирует текущее местоположение пользователя и возвращает список пользователей, которые находятся вблизи.
     *
     * @param float $latitude
     * @param float $longitude
     * @param integer $accuracy
     * @param integer $radius
     * @param array|null $fields
     * @param string|null $nameCase
     * @param integer|null $timeout
     * @return UsersListResponse
     * @throws \Exception
     * @throws \VkApi\Exception\Api\TooManyRequestsException
     */
    public function getNearby($latitude, $longitude, $accuracy, $radius = Radius::METERS_300, $fields = null, $nameCase = NameCase::NOMINATIVE, $timeout = null)
    {
        $parameters = $this->prepareParametersFromArguments(['fields']);
        $request = $this->createRequest($parameters);

        // TODO implement response for this call
        return $request->make(UsersListResponse::class);
    }
}