<?php

namespace VkApi\Entity;

class User extends BasicEntity
{
    public function getId()
    {
        return $this->getRawData()->id;
    }

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
        return $this->getConnection()->users->getById($this->getId(), null, $nameCase);
    }
}