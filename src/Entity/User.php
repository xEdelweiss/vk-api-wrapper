<?php

namespace VkApi\Entity;

use VkApi\Entity\Traits\WithId;

class User extends BasicEntity
{
    use WithId;

    public function getFirstName()
    {
        return $this->getRawData()->first_name;
    }

    public function getLastName()
    {
        return $this->getRawData()->last_name;
    }

    public function changeNameCase($nameCase)
    {
        return $this->getConnection()->users->getUser($this->getId(), null, $nameCase);
    }
}