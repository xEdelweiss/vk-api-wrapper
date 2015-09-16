<?php

namespace VkApi\Api;

use Exception;
use VkApi\Enum\MessagesFilter;
use VkApi\Enum\MessagesOrder;
use VkApi\Exception\Api\TooManyRequestsException;
use VkApi\Response\DialogsListResponse;
use VkApi\Response\MessagesListResponse;

/**
 * Class Messages
 * @package VkApi\Api
 */
class Messages extends BasicApi
{
    /**
     * Returns a list of the current user's incoming or outgoing private messages.
     *
     * @param integer|null $count          Number of messages to return.
     * @param integer|null $offset         Offset needed to return a specific subset of messages.
     * @param boolean|null $out            Show only outgoing messages
     * @param integer|null $filters        Filters. @see \VkApi\Enum\MessagesFilter
     * @param integer|null $previewLength  Number of characters after which to truncate a previewed message. To preview the full message, specify 0.
     * @param integer|null $lastMessageId  ID of the message received before the message that will be returned last (provided that no more than count messages were received before it; otherwise offset parameter shall be used).
     * @param integer|null $timeOffset     Maximum time since a message was sent, in seconds. To return messages without a time limitation, set as 0.
     *
     * @return MessagesListResponse
     */
    public function get($count = null, $offset = null, $out = null, $filters = MessagesFilter::NOT_FILTERED, $previewLength = null, $lastMessageId = null, $timeOffset = null)
    {
        $parameters = $this->prepareParametersFromArguments();
        $request = $this->createRequest($parameters);

        return $request->make(MessagesListResponse::class);
    }

    /**
     * Returns a list of the current user's conversations.
     *
     * @param integer|null $count           Number of messages to return.
     * @param integer|null $offset          Offset needed to return a specific subset of messages.
     * @param boolean|null $unread          Show only unread dialogs.
     * @param integer|null $startMessageId  Starting message ID from which to return history.
     * @param boolean|null $previewLength   Number of characters after which to truncate a previewed message. To preview the full message, specify 0.
     *
     * @return DialogsListResponse
     *
     * @throws Exception
     * @throws TooManyRequestsException
     */
    public function getDialogs($count = null, $offset = null, $unread = null, $startMessageId = null, $previewLength = null)
    {
        $parameters = $this->prepareParametersFromArguments();
        $request = $this->createRequest($parameters);

        return $request->make(DialogsListResponse::class);
    }

    /**
     * Returns messages by their IDs.
     *
     * @param array         $messageIds     Message IDs
     * @param boolean|null  $previewLength  Number of characters after which to truncate a previewed message. To preview the full message, specify 0.
     *
     * @return MessagesListResponse
     *
     * @throws Exception
     * @throws TooManyRequestsException
     */
    public function getById($messageIds, $previewLength = null)
    {
        $parameters = $this->prepareParametersFromArguments(['messageIds']);
        $request = $this->createRequest($parameters);

        return $request->make(MessagesListResponse::class);
    }

    /**
     * Returns a list of the current user's private messages that match search criteria.
     *
     * @param string        $searchFor      Search query string.
     * @param integer|null  $count          Number of messages to return.
     * @param integer|null  $offset         Offset needed to return a specific subset of messages.
     * @param boolean|null  $previewLength  Number of characters after which to truncate a previewed message. To preview the full message, specify 0.
     *
     * @return MessagesListResponse
     *
     * @throws Exception
     * @throws TooManyRequestsException
     */
    public function search($searchFor, $count = null, $offset = null, $previewLength = null)
    {
        $parameters = $this->prepareParametersFromArguments([], ['searchFor' => 'q']);
        $request = $this->createRequest($parameters);

        return $request->make(MessagesListResponse::class);
    }

    /**
     * Returns message history for the specified user or group chat.
     *
     * @param integer       $userId          ID of the user whose message history you want to return.
     * @param integer|null  $chatId
     * @param integer|null  $count           Number of messages to return.
     * @param integer|null  $offset          Offset needed to return a specific subset of messages.
     * @param integer|null  $rev             Sort order. @see \VkApi\Enum\MessagesOrder
     * @param integer|null  $startMessageId  Starting message ID from which to return history.
     *
     * @return MessagesListResponse
     *
     * @throws Exception
     * @throws TooManyRequestsException
     */
    public function getHistory($userId, $chatId = null, $count = null, $offset = null, $rev = MessagesOrder::NEW_FIRST, $startMessageId = null)
    {
        $parameters = $this->prepareParametersFromArguments();
        $request = $this->createRequest($parameters);

        return $request->make(MessagesListResponse::class);
    }
}