<?php

namespace VkApi\Response;

use VkApi\Entity\User;

/**
 * Class UsersListResponse
 * @package VkApi\Response
 */
class UsersListResponse extends ListResponse
{
    public function getItems($class = User::class)
    {
        return $this->arrayToObjectOfClass($this->getParsedResponse()->response, $class);
    }
}