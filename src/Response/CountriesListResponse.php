<?php

namespace VkApi\Response;

use VkApi\Entity\Country;

class CountriesListResponse extends ListResponse
{
    /**
     * @param $class
     * @return Country[]
     */
    public function getItems($class = Country::class)
    {
        return parent::getItems($class);
    }

}