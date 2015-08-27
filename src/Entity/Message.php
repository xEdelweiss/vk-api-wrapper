<?php

namespace VkApi\Entity;

use Carbon\Carbon;
use VkApi\Entity\Traits\WithId;
use VkApi\Exception\NotImplemetedException;
use VkApi\Utils;

class Message extends BasicEntity
{
    use WithId;

    /**
     * @return User
     */
    public function getAuthor()
    {
        $fromId = $this->getRawValue('from_id');
        $userId = $this->getRawValue('user_id');

        return $this->getConnection()->users->getUser(Utils::getNotNull($fromId, $userId));
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->getRawValue('body');
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->getRawValue('title');
    }

    /**
     * @param \DateTimeZone|string $timeZone
     *
     * @return Carbon
     */
    public function getSentDate($timeZone = null)
    {
        $date = $this->getRawValue('date');
        return Carbon::createFromTimestamp($date, $timeZone);
    }

    /**
     * @return bool
     */
    public function isRead()
    {
        return (bool)$this->getRawValue('read_state');
    }

    /**
     * @return bool
     */
    public function isOutgoing()
    {
        return (bool)$this->getRawValue('out');
    }

    /**
     * @return bool
     */
    public function isIncoming()
    {
        return !$this->isOutgoing();
    }

    /**
     * @return bool
     */
    public function isImportant()
    {
        return (bool)$this->getRawValue('important');
    }

    /**
     * @return bool
     */
    public function isDeleted()
    {
        return (bool)$this->getRawValue('deleted');
    }

    /**
     * @return bool
     */
    public function hasEmoji()
    {
        return (bool)$this->getRawValue('emoji');
    }

    public function getGeoCoordinates()
    {
        throw new NotImplemetedException;
        // TODO geo http://vk.com/dev/message
    }

    public function getAttachments()
    {
        throw new NotImplemetedException;
        // TODO attachments array of http://vk.com/dev/attachments_m
    }

    public function getForwardedMessages()
    {
        throw new NotImplemetedException;
        // TODO fwd_messages http://vk.com/dev/message
    }

    /**
     * @return bool
     */
    public function isChat()
    {
        return (bool)$this->getRawValue('chat_id');
    }

    /**
     * @return bool
     */
    public function getChatId()
    {
        return (bool)$this->getRawValue('chat_id');
    }

    /**
     * @return bool
     */
    public function getChatActive()
    {
        return (bool)$this->getRawValue('chat_active');
    }

    /**
     * @return int
     */
    public function getUsersCount()
    {
        return (int)$this->getRawValue('users_count');
    }

    /**
     * @return User
     */
    public function getAdmin()
    {
        $adminId = $this->getRawValue('admin_id');

        if (!$adminId) {
            return null;
        }

        return $this->getConnection()->users->getUser($adminId);
    }

    /**
     * @return bool
     */
    public function isServiceMessage()
    {
        return (bool)$this->getRawValue('action');
    }

    public function getServiceMessageAction()
    {
        if (!$this->isServiceMessage()) {
            return null;
        }

        throw new NotImplemetedException;
        // TODO action_*
    }

    public function getPushSettings()
    {
        throw new NotImplemetedException;
        // TODO push_settings
    }

    /**
     * Do not make request for Extended entity
     *
     * @param $key
     * @param bool|false $requestExtended
     * @param null $default
     * @return mixed
     */
    public function getRawValue($key, $requestExtended = false, $default = null)
    {
        return parent::getRawValue($key, $requestExtended, $default);
    }

}