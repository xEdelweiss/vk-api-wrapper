<?php

namespace VkApi\Entity\Traits;

trait DisableExtendedEntityRequest
{
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