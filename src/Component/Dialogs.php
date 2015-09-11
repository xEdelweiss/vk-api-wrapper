<?php

namespace VkApi\Component;

use VkApi\Response\DialogsListResponse;

class Dialogs extends BasicComponent
{
    static $prefix = 'messages';

    /**
     * @param null $count
     * @param null $offset
     * @param null $startMessageId
     * @param null $previewLength
     *
     * @return DialogsListResponse
     *
     * TODO convert it to MessageListResponse?
     */
    public function getUnread($count = null, $offset = null, $startMessageId = null, $previewLength = null)
    {
        return $this->api->messages
            ->getDialogs($count, $offset, true, $startMessageId, $previewLength);
    }
}