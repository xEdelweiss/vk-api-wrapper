<?php

namespace VkApi\Response;

use VkApi\Entity\Country;

/**
 * Class SpecificCountriesListResponse
 * @package VkApi\Response
 */
class SpecificCountriesListResponse extends CountriesListResponse
{
    /**
     * @return int
     */
    public function getCountAll()
    {
        return $this->getRequest()->getConnection()->countries->get()->getCountAll();
    }

    /**
     * @param $class
     * @return Country[]
     */
    public function getItems($class = Country::class)
    {
        return $this->arrayToObjectOfClass($this->getParsedResponse()->response, $class);
    }

}