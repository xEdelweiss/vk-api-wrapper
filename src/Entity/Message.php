<?php

namespace VkApi\Entity;

use VkApi\Entity\Traits\WithId;
use VkApi\Utils;

class Message extends BasicEntity
{
    use WithId;

    public function getAuthor()
    {
        $fromId = $this->getRawValue('from_id', false);
        $userId = $this->getRawValue('user_id', false);

        return $this->getConnection()->users->getUser(Utils::getNotNull($fromId, $userId));
    }

    public function getText()
    {
        return $this->getRawValue('body', false);
    }
}