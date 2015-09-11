<?php

namespace VkApi\Component;

use VkApi\Entity\Message;
use VkApi\Response\MessagesListResponse;

class Messages extends BasicComponent
{
    static $prefix = 'messages';

    /**
     * @param null $count
     * @param null $offset
     * @param null $out
     * @param null $filters
     * @param null $previewLength
     * @param null $lastMessageId
     * @param null $timeOffset
     * @return MessagesListResponse
     */
    public function get($count = null, $offset = null, $out = null, $filters = null, $previewLength = null, $lastMessageId = null, $timeOffset = null)
    {
        return $this->api->messages
            ->get($count, $offset, $out, $filters, $previewLength, $lastMessageId, $timeOffset);
    }

    /**
     * @param array $ids
     * @return MessagesListResponse
     */
    public function getMessagesById(array $ids)
    {
        return $this->api->messages
            ->getById($ids);
    }

    /**
     * @param $id
     * @return \VkApi\Entity\Message
     */
    public function getMessage($id)
    {
        return $this->getMessagesById([$id])
            ->getFirstItem();
    }

    /**
     * @param null $count
     * @param null $offset
     * @param null $startMessageId
     * @param null $previewLength
     * @return Message[]
     *
     * TODO convert it to MessageListResponse?
     */
    public function getUnread($count = null, $offset = null, $startMessageId = null, $previewLength = null)
    {
        return $this->dialogs
            ->getUnread($count, $offset, $startMessageId, $previewLength)
            ->getColumn('message');
    }
}