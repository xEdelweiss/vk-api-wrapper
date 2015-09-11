<?php

namespace VkApi\Component;

class Cities extends BasicComponent
{
    static $prefix = 'database';

    /**
     * @param $countryId
     * @param null $regionId
     * @param null $searchFor
     * @return \VkApi\Response\CitiesListResponse
     */
    public function get($countryId, $regionId = null, $searchFor = null)
    {
        return $this->api->database
            ->getCities($countryId, $regionId, $searchFor);
    }

    /**
     * @param $id
     * @return \VkApi\Entity\Country
     */
    public function getCity($id)
    {
        return $this->api->database
            ->getCitiesById([$id])
            ->getFirstItem();
    }

    /**
     * @param integer $countryId
     * @param string|null $searchFor
     * @return \VkApi\Response\CitiesListResponse
     */
    public function getByCountryId($countryId, $searchFor = null)
    {
        return $this->get($countryId, null, $searchFor);
    }
}