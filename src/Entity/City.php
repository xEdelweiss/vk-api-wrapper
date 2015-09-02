<?php

namespace VkApi\Entity;

use VkApi\Entity\Traits\DisableExtendedEntityRequest;
use VkApi\Entity\Traits\WithId;

class City extends BasicEntity
{
    use WithId, DisableExtendedEntityRequest;

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->getRawValue('title');
    }

    public function getRegionName()
    {
        return $this->getRawValue('region');
    }

    public function getAreaName()
    {
        return $this->getRawValue('area');
    }
}