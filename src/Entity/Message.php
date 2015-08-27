<?php

namespace VkApi\Entity;

use VkApi\Entity\Traits\WithId;

class Message extends BasicEntity
{
    use WithId;

    public function getAuthor()
    {
        return $this->getConnection()->users->getUser(
            isset($this->getRawData()->from_id) ? $this->getRawData()->from_id : $this->getRawData()->user_id
        );
    }

    public function getText()
    {
        return $this->getRawData()->body;
    }
}