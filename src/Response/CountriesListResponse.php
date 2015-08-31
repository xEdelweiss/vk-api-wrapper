<?php

namespace VkApi\Response;

use VkApi\Entity\Country;
use VkApi\Response\Traits\WithCountAll;

class CountriesListResponse extends ListResponse
{
    use WithCountAll;

    /**
     * @param $class
     * @return Country[]
     */
    public function getItems($class = Country::class)
    {
        return parent::getItems($class);
    }

}