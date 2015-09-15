<?php

namespace VkApi\Entity;

use VkApi\Entity\Traits\DisableExtendedEntityRequest;
use VkApi\Entity\Traits\WithId;
use VkApi\Entity\Traits\WithTitle;
use VkApi\Response\RegionsListResponse;

class Country extends BasicEntity
{
    use WithId, WithTitle, DisableExtendedEntityRequest;

    /**
     * @param string $searchFor
     * @return RegionsListResponse
     */
    public function getRegions($searchFor = null)
    {
        return $this->getConnection()->regions
            ->getByCountryId($this->getId(), $searchFor);
    }

    /**
     * @param string $searchFor
     * @return \VkApi\Response\CitiesListResponse
     */
    public function getCities($searchFor = null)
    {
        return $this->getConnection()->cities
            ->getByCountryId($this->getId(), $searchFor);
    }
}