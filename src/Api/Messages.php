<?php

namespace VkApi\Api;

use VkApi\Response\DialogsListResponse;
use VkApi\Response\MessagesListResponse;

class Messages extends BasicApi
{
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
    public function getById($ids)
    {
        $parameters = $this->prepareParameters([
            'message_id' => implode(',', $this->ensureIsArray($ids)),
        ]);

        $request = $this->getConnection()->createRequest($this->getFullMethodName('getById'), $parameters);

        // TODO specific?
        return $request->make(MessagesListResponse::class);
    }

    /**
     * @param null $count
     * @param null $offset
     * @param null $unread
     * @param null $startMessageId
     * @param null $previewLength
     * @return \VkApi\Response\DialogsListResponse
     * @throws \Exception
     * @throws \VkApi\Exception\Api\TooManyRequestsException
     */
    public function getDialogs($count = null, $offset = null, $unread = null, $startMessageId = null, $previewLength = null)
    {
        $parameters = $this->prepareParameters([
            'offset' => $offset,
            'count' => $count,
            'unread' => $unread,
            'start_message_id' => $startMessageId,
            'preview_length' => $previewLength,
        ]);

        $request = $this->getConnection()->createRequest($this->getFullMethodName('getDialogs'), $parameters);

        return $request->make(DialogsListResponse::class);
    }
}