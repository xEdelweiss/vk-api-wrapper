<?php

namespace VkApi\Response;

use VkApi\Entity\Message;

class MessagesListResponse extends ListResponse
{
    /**
     * @param $class
     * @return Message[]
     */
    public function getItems($class = Message::class)
    {
        return parent::getItems($class);
    }

}