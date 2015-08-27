<?php

namespace VkApi\Entity;

use Carbon\Carbon;
use Intervention\Image\ImageManagerStatic;
use VkApi\Entity\Traits\WithId;
use VkApi\Enum\UserPhotoSize;
use VkApi\Exception\Invalid\InvalidPhotoSizeException;

class User extends BasicEntity
{
    use WithId;

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->getRawValue('first_name', false);
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->getRawValue('last_name', false);
    }

    /**
     * @return string
     */
    public function getNickName()
    {
        return $this->getRawValue('nickname');
    }

    /**
     * @return bool
     */
    public function isOnline()
    {
        return (bool) $this->getRawValue('online');
    }

    /**
     * @return Carbon|null
     */
    public function getBirthday()
    {
        // DD.MM || DD.MM.YYY
        $date = $this->getRawValue('bdate');

        if (is_null($date)) {
            return $date;
        }

        $date = substr_count($date, '.') > 1 ? $date : $date.'.0';
        return Carbon::createFromFormat('d.m.Y', $date);
    }

    /**
     * @return string
     *
     * TODO what is the difference between screen_name and domain
     */
    public function getScreenName()
    {
        return $this->getRawValue('screen_name');
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->getRawValue('status');
    }

    /**
     * @return int
     */
    public function getSex()
    {
        return $this->getRawValue('sex');
    }

    /**
     * @return bool
     */
    public function hasMobile()
    {
        return (bool) $this->getRawValue('has_mobile');
    }

    /**
     * @return string
     */
    public function getMobilePhoneNumber()
    {
        return $this->getRawValue('mobile_phone');
    }

    /**
     * @return string
     */
    public function getHomePhoneNumber()
    {
        return $this->getRawValue('home_phone');
    }

    /**
     * @param string $size
     * @return string
     * @throws InvalidPhotoSizeException
     */
    public function getPhotoUrl($size = UserPhotoSize::MEDIUM_SQUARE)
    {
        if (!in_array($size, UserPhotoSize::all())) {
            throw new InvalidPhotoSizeException($size, UserPhotoSize::all());
        }

        return $this->getRawValue('photo_' . $size);
    }

    public function getPhoto($size = UserPhotoSize::MEDIUM_SQUARE)
    {
        $photoUrl = $this->getPhotoUrl($size);

        if (!$photoUrl) {
            return null;
        }

        return ImageManagerStatic::make($photoUrl);
    }

    /**
     * @param bool|true $absolute
     * @param bool|true $secure
     * @return string
     *
     * TODO what is the difference between screen_name and domain
     */
    public function getPageUrl($absolute = true, $secure = true)
    {
        $domain = $this->getRawValue('domain');

        if (!$absolute) {
            return $domain;
        }

        return ($secure ? 'https://' : 'http://') . $this->getConnection()->getVkDomain() . '/' . $domain;
    }

    /**
     * @param $nameCase
     * @return $this
     */
    public function changeNameCase($nameCase)
    {
        $updatedEntity = $this->getConnection()->users->getUser($this->getId(), $this->getOriginalRequestParameter('fields'), $nameCase);
        $this->mergeWith($updatedEntity);

        return $this;
    }

    protected function requestExtendedRawData()
    {
        $nameCase = $this->getOriginalRequestParameter('name_case');

        return $this->getConnection()->users->getUserWithFullInfo($this->getId(), $nameCase);
    }

}