<?php

namespace VkApi\Entity;

use Carbon\Carbon;
use Intervention\Image\ImageManagerStatic;
use VkApi\Entity\Traits\DisableExtendedEntityRequest;
use VkApi\Entity\Traits\WithId;
use VkApi\Enum\ChatPhotoSize;
use VkApi\Exception\Invalid\InvalidPhotoSizeException;
use VkApi\Exception\NotImplemetedException;
use VkApi\Utils;

class Message extends BasicEntity
{
    use WithId, DisableExtendedEntityRequest;

    /**
     * @return User
     *
     * TODO check the difference between from_id and user_id
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

    public function hasAttachments()
    {
        return !!$this->getRawValue('attachments');
    }

    public function getAttachments()
    {
        throw new NotImplemetedException;
        // TODO attachments array of http://vk.com/dev/attachments_m
    }

    public function hasForwardedMessages()
    {
        return !!$this->getRawValue('fwd_messages');
    }

    public function getForwardedMessages()
    {
        $messages = $this->getRawValue('fwd_messages');

        return Utils::convertArrayToArrayOfObjects($messages, static::class, [], $this->getConnection());
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
     * @param string $size
     * @return string
     * @throws InvalidPhotoSizeException
     */
    public function getChatPhotoUrl($size = ChatPhotoSize::MEDIUM)
    {
        if (!in_array($size, ChatPhotoSize::all())) {
            throw new InvalidPhotoSizeException($size, ChatPhotoSize::all());
        }

        return $this->getRawValue('photo_' . $size);
    }

    public function getChatPhoto($size = ChatPhotoSize::MEDIUM)
    {
        $photoUrl = $this->getChatPhotoUrl($size);

        if (!$photoUrl) {
            return null;
        }

        return ImageManagerStatic::make($photoUrl);
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

}