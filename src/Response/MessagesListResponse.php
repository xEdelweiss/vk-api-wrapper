<?php

namespace VkApi\Response;

use VkApi\Entity\Message;
use VkApi\Response\Traits\WithCountAll;

/**
 * Class MessagesListResponse
 * @package VkApi\Response
 *
 * @method Message[] getItems
 */
class MessagesListResponse extends ListResponse
{
    use WithCountAll;

    protected $entityClass = Message::class;

}