<?php

namespace VkApi\Response;

use VkApi\Entity\User;

class UsersListResponse extends ListResponse
{
    public function getCount()
    {
        return count($this->getParsedResponse()->response);
    }

    public function getItems($class = User::class)
    {
        return $this->arrayToObjectOfClass($this->getParsedResponse()->response, $class);
    }
}