<?php

namespace VkApi\Component;

use VkApi\Response\DialogsListResponse;

class Dialogs extends BasicComponent
{
    static $prefix = 'messages';

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