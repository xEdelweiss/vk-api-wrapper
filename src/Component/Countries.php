<?php

namespace VkApi\Component;

use VkApi\Response\CountriesListResponse;
use VkApi\Response\SpecificCountriesListResponse;

class Countries extends BasicComponent
{
    static $prefix = 'database';

    /**
     * @param array $codes
     * @param integer|null $count
     * @param integer|null $offset
     * @return CountriesListResponse
     */
    public function getCountriesByCode($codes, $count = null, $offset = null)
    {
        return $this->api->database
            ->getCountries(null, $codes, $count, $offset);
    }

    /**
     * @param int $id
     * @return \VkApi\Entity\Country
     */
    public function getCountry($id)
    {
        return $this->api->database
            ->getCountriesById([$id])
            ->getFirstItem();
    }

    /**
     * @param string $code
     * @return \VkApi\Entity\Country
     */
    public function getCountryByCode($code)
    {
        return $this->getCountriesByCode([$code])
            ->getFirstItem();
    }
}