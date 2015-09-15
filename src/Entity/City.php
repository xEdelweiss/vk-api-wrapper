<?php

namespace VkApi\Entity;

use VkApi\Entity\Traits\DisableExtendedEntityRequest;
use VkApi\Entity\Traits\WithId;
use VkApi\Entity\Traits\WithTitle;

class City extends BasicEntity
{
    use WithId, WithTitle, DisableExtendedEntityRequest;

    public function getRegionName()
    {
        return $this->getRawValue('region');
    }

    public function getAreaName()
    {
        return $this->getRawValue('area');
    }
}