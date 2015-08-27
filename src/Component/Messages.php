<?php

namespace VkApi\Component;

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
}