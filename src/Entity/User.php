<?php

namespace VkApi\Entity;

use VkApi\Entity\Traits\WithId;

class User extends BasicEntity
{
    use WithId;

    public function getFirstName()
    {
        return $this->getRawValue('first_name', false);
    }

    public function getLastName()
    {
        return $this->getRawValue('last_name', false);
    }

    public function changeNameCase($nameCase)
    {
        $updatedEntity = $this->getConnection()->users->getUser($this->getId(), $this->getOriginalRequestParameter('fields'), $nameCase);
        $this->mergeWith($updatedEntity);

        return $this;
    }

    protected function requestExtendedRawData()
    {
        $nameCase = $this->getOriginalRequestParameter('name_case');

        return $this->getConnection()->users->getUserWithFullInfo($this->getId(), $nameCase);
    }

}