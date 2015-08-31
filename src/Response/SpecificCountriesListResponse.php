<?php

namespace VkApi\Response;

use VkApi\Entity\Country;

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
     * @return int
     */
    public function getCount()
    {
        return count($this->getParsedResponse()->response);
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