<?php

namespace VkApi\Entity;

class Message extends BasicEntity
{
    public function getId()
    {
        return $this->getRawData()->id;
    }

    public function getAuthor()
    {
        return $this->getConnection()->users->getById(
            isset($this->getRawData()->from_id) ? $this->getRawData()->from_id : $this->getRawData()->user_id
        );
    }

    public function getText()
    {
        return $this->getRawData()->body;
    }
}