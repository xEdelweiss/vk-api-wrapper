<?php

namespace VkApi\Entity;

use VkApi\Entity\Traits\DisableExtendedEntityRequest;
use VkApi\Entity\Traits\WithId;

class Dialog extends BasicEntity
{
    use WithId, DisableExtendedEntityRequest;

    /**
     * @return Message
     */
    public function getMessage()
    {
        $messageId = $this->getRawData()->message->id;

        return $this->getConnection()->messages
            ->getMessage($messageId);
    }
}