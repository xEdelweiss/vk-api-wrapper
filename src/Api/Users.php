<?php

namespace VkApi\Api;

use VkApi\Query\UserSearchQuery;
use VkApi\Response\BasicResponse;
use VkApi\Response\UsersListResponse;

class Users extends BasicApi
{
    /**
     * ���������� ����������� ���������� � �������������.
     *
     * @param array $userIds
     * @param array|null $fields
     * @param string|null $nameCase
     * @return UsersListResponse
     */
    public function get($userIds = null, $fields = null, $nameCase = null)
    {
        // ���� counters, military ����� ���������� ������ � ������, ���� ������� ����� ���� user_id
        $parameters = $this->prepareParametersFromArguments();
        $request = $this->createRequest($parameters);

        return $request->make(UsersListResponse::class);
    }

    /**
     * ���������� ������ ������������� � ������������ � �������� ��������� ������.
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
     * ���������� ���������� � ���, ��������� �� ������������ ����������.
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
     * ���������� ������ ��������������� ������������� � ���������, ������� ������ � ������ �������� ������������.
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
}