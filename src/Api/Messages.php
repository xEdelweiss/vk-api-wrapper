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

        $request = $this->createRequest($parameters);

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

        $request = $this->createRequest($parameters);

        return $request->make(DialogsListResponse::class);
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

        $request = $this->createRequest($parameters);

        // TODO specific?
        return $request->make(MessagesListResponse::class);
    }

    /**
     * @param $searchFor
     * @param integer|null $count
     * @param integer|null $offset
     * @param boolean|null $previewLength
     * @return \VkApi\Response\BasicResponse
     * @throws \Exception
     * @throws \VkApi\Exception\Api\TooManyRequestsException
     */
    public function search($searchFor, $count = null, $offset = null, $previewLength = null)
    {
        $parameters = $this->prepareParameters([
            'q' => $searchFor,
            'offset' => $offset,
            'count' => $count,
            'preview_length' => $previewLength,
        ]);

        $request = $this->createRequest($parameters);

        return $request->make(MessagesListResponse::class);
    }

    /**
     * @param $userId
     * @param null $chatId
     * @param integer|null $count
     * @param integer|null $offset
     * @param null $rev
     * @param null $startMessageId
     * @return \VkApi\Response\BasicResponse
     * @throws \Exception
     * @throws \VkApi\Exception\Api\TooManyRequestsException
     */
    public function getHistory($userId, $chatId = null, $count = null, $offset = null, $rev = null, $startMessageId = null)
    {
        $parameters = $this->prepareParameters([
            'user_id' => $userId,
            'chat_id' => $chatId,
            'offset' => $offset,
            'count' => $count,
            'rev' => $rev,
            'start_message_id' => $startMessageId,
        ]);

        $request = $this->createRequest($parameters);

        return $request->make(MessagesListResponse::class);
    }
}