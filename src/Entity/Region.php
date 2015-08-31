<?php

namespace VkApi\Entity;

use VkApi\Entity\Traits\DisableExtendedEntityRequest;
use VkApi\Entity\Traits\WithId;

class Region extends BasicEntity
{
    use WithId, DisableExtendedEntityRequest;

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->getRawValue('title');
    }
}