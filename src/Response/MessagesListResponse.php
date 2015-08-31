<?php

namespace VkApi\Response;

use VkApi\Entity\Message;
use VkApi\Response\Traits\WithCountAll;

class MessagesListResponse extends ListResponse
{
    use WithCountAll;

    /**
     * @param $class
     * @return Message[]
     */
    public function getItems($class = Message::class)
    {
        return parent::getItems($class);
    }

}