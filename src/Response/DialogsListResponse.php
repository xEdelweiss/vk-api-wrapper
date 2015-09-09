<?php

namespace VkApi\Response;
use VkApi\Entity\Dialog;
use VkApi\Response\Traits\WithCountAll;

/**
 * Class DialogsListResponse
 * @package VkApi\Response
 *
 * @method Dialog[] getItems
 */
class DialogsListResponse extends ListResponse
{
    use WithCountAll;

    protected $entityClass = Dialog::class;

    /**
     * @return int
     */
    public function getUnreadCount()
    {
        // unread_dialogs is not set if only unread dialogs was requested
        return isset($this->getParsedResponse()->response->unread_dialogs)
            ? $this->getParsedResponse()->response->unread_dialogs
            : $this->getCountAll();
    }
}