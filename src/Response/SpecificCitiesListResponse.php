<?php

namespace VkApi\Response;

use VkApi\Entity\City;

/**
 * Class SpecificCitiesListResponse
 * @package VkApi\Response
 */
class SpecificCitiesListResponse extends CitiesListResponse
{
    /**
     * @return int
     *
     * TODO think about count_all for cities
     */
    public function getCountAll()
    {
        return null;
    }

    /**
     * @param $class
     * @return City[]
     */
    public function getItems($class = City::class)
    {
        return $this->arrayToObjectOfClass($this->getParsedResponse()->response, $class);
    }

}