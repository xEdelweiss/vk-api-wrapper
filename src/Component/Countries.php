<?php

namespace VkApi\Component;

use VkApi\Response\CountriesListResponse;
use VkApi\Response\SpecificCountriesListResponse;

class Countries extends BasicComponent
{
    static $prefix = 'database';

    /**
     * @param null $needAll
     * @param null $code
     * @param null $count
     * @param null $offset
     * @return \VkApi\Response\CountriesListResponse
     * @throws \Exception
     * @throws \VkApi\Exception\Api\TooManyRequestsException
     */
    public function get($needAll = null, $code = null, $count = null, $offset = null)
    {
        $parameters = $this->prepareParameters([
            'need_all' => $needAll,
            'code' => implode(',', $this->ensureIsArray($code)),
            'count' => $count,
            'offset' => $offset,
        ]);

        $request = $this->getConnection()->createRequest($this->getFullMethodName('getCountries'), $parameters);

        return $request->make(CountriesListResponse::class);
    }

    /**
     * @param $ids
     * @return \VkApi\Response\CountriesListResponse
     * @throws \Exception
     * @throws \VkApi\Exception\Api\TooManyRequestsException
     */
    public function getCountriesById($ids)
    {
        $parameters = $this->prepareParameters([
            'country_ids' => implode(',', $this->ensureIsArray($ids)),
        ]);

        $request = $this->getConnection()->createRequest($this->getFullMethodName('getCountriesById'), $parameters);

        return $request->make(SpecificCountriesListResponse::class);
    }

    /**
     * @param $id
     * @return \VkApi\Entity\Country
     */
    public function getCountry($id)
    {
        $result = $this->getCountriesById([$id]);

        return $result->getFirstItem();
    }
}