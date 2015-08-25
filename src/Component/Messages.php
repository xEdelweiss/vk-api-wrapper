<?php

namespace VkApi\Component;

use VkApi\Response\ListResponse;

class Messages extends Basic
{
    static $prefix = 'messages';

    /**
     * @param int $count
     * @param int $offset
     * @param null $isOut
     * @param null $isImportant
     * @param null $previewLength
     * @param null $lastMessageId
     * @param null $timeOffset
     *
     * @return ListResponse
     */
    public function get($count = 20, $offset = 0, $isOut = null, $isImportant = null, $previewLength = null, $lastMessageId = null, $timeOffset = null)
    {
        $parameters = array_filter([
            'out' => $isOut ? 1 : 0,
            'offset' => $offset,
            'count' => $count,
            'time_offset' => $timeOffset,
            'filters' => $isImportant ? 8 : null,
            'preview_length' => $previewLength,
            'last_message_id' => $lastMessageId,
        ]);

        $request = $this->wrapper()->createRequest($this->method('get'), $parameters);

        return $request->make(ListResponse::class);
    }
}