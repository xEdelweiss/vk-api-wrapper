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

        return $countryId ? $this->getConnection()->countries->getCountry($countryId) : null;
    }
}