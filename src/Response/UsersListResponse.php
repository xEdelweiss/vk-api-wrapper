<?php

namespace VkApi\Response;

use VkApi\Entity\User;

/**
 * Class UsersListResponse
 * @package VkApi\Response
 */
class UsersListResponse extends ListResponse
{
    /**
     * @param null $class
     * @return array
     *
     * TODO split to SpecificUsersListResponse?
     */
    public function getItems($class = User::class)
    {
        return $this->arrayToObjectOfClass(
            isset($this->getParsedResponse()->response->items)
                ? $this->getParsedResponse()->response->items
                : $this->getParsedResponse()->response,
            $class
        );
    }
}