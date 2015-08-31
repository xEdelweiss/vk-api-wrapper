<?php

namespace VkApi\Entity;

use VkApi\Entity\Traits\DisableExtendedEntityRequest;
use VkApi\Entity\Traits\WithId;
use VkApi\Response\RegionsListResponse;

class Country extends BasicEntity
{
    use WithId, DisableExtendedEntityRequest;

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->getRawValue('title');
    }

    /**
     * @param string $searchFor
     * @return RegionsListResponse
     */
    public function getRegions($searchFor = null)
    {
        return $this->getConnection()->regions->get($this->getId(), $searchFor);
    }
}