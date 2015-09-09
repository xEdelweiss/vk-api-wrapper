<?php

namespace VkApi\Component;

use VkApi\Entity\Message;
use VkApi\Response\MessagesListResponse;

class Messages extends BasicComponent
{
    static $prefix = 'messages';

    /**
     * @param int $count
     * @param int $offset
     * @param null $out
     * @param null $filters
     * @param null $previewLength
     * @param null $lastMessageId
     * @param null $timeOffset
     * @return MessagesListResponse
     */
    public function get($count = null, $offset = null, $out = null, $filters = null, $previewLength = null, $lastMessageId = null, $timeOffset = null)
    {
        $parameters = $this->prepareParameters([
            'out' => $out,
            'offset' => $offset,
            'count' => $count,
            'time_offset' => $timeOffset,
            'filters' => $filters,
            'preview_length' => $previewLength,
            'last_message_id' => $lastMessageId,
        ]);

        $request = $this->getConnection()->createRequest($this->getFullMethodName('get'), $parameters);

        return $request->make(MessagesListResponse::class);
    }

    /**
     * @param array $ids
     * @return \VkApi\Response\MessagesListResponse
     * @throws \Exception
     * @throws \VkApi\Exception\Api\TooManyRequestsException
     */
    public function getMessagesById($ids)
    {
        $parameters = $this->prepareParameters([
            'message_id' => implode(',', $this->ensureIsArray($ids)),
        ]);

        $request = $this->getConnection()->createRequest($this->getFullMethodName('getById'), $parameters);

        // TODO specific?
        return $request->make(MessagesListResponse::class);
    }

    /**
     * @param $id
     * @return \VkApi\Entity\Message
     */
    public function getMessage($id)
    {
        $result = $this->getMessagesById([$id]);

        return $result->getFirstItem();
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
        $dialogs = $this->getConnection()->dialogs->getDialogs($count, $offset, true, $startMessageId, $previewLength);
        $messages = $dialogs->getColumn('message');

        return $messages;
    }
}