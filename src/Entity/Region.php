<?php

namespace VkApi\Entity;

use VkApi\Entity\Traits\DisableExtendedEntityRequest;
use VkApi\Entity\Traits\WithId;
use VkApi\Entity\Traits\WithTitle;

class Region extends BasicEntity
{
    use WithId, WithTitle, DisableExtendedEntityRequest;

    public function getCountryId()
    {
        return $this->getOriginalRequestParameter('country_id');
    }

    /**
     * @return null|Country
     */
    public function getCountry()
    {
        $countryId = $this->getCountryId();

        return $countryId
            ? $this->getConnection()->countries->getCountry($countryId)
            : null;
    }

    /**
     * @param string $searchFor
     * @return \VkApi\Response\CitiesListResponse
     */
    public function getCities($searchFor = null)
    {
        return $this->getConnection()->cities
            ->get($this->getCountryId(), $this->getId(), $searchFor);
    }
}