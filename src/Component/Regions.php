<?php

namespace VkApi\Component;

use VkApi\Response\RegionsListResponse;

class Regions extends BasicComponent
{
    static $prefix = 'database';

    /**
     * @param integer $countryId
     * @param string|null $searchFor
     * @return RegionsListResponse
     */
    public function getByCountryId($countryId, $searchFor = null)
    {
        return $this->api->database
            ->getRegions($countryId, $searchFor);
    }
}