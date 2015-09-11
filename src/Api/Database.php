<?php

namespace VkApi\Api;

use VkApi\Response\CitiesListResponse;
use VkApi\Response\CountriesListResponse;
use VkApi\Response\RegionsListResponse;
use VkApi\Response\SpecificCitiesListResponse;

class Database extends BasicApi
{
    /**
     * @param bool|null $needAll
     * @param array|null $code
     * @param integer|null $count
     * @param integer|null $offset
     * @return \VkApi\Response\CountriesListResponse
     * @throws \Exception
     * @throws \VkApi\Exception\Api\TooManyRequestsException
     */
    public function getCountries($needAll = null, $code = null, $count = null, $offset = null)
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
     * @param array $ids
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
     * @param $countryId
     * @param string|null $searchBy
     * @param integer|null $count
     * @param integer|null $offset
     * @return \VkApi\Response\RegionsListResponse
     * @throws \Exception
     * @throws \VkApi\Exception\Api\TooManyRequestsException
     */
    public function getRegions($countryId, $searchBy = null, $count = null, $offset = null)
    {
        $parameters = $this->prepareParameters([
            'country_id' => $countryId,
            'q' => $searchBy,
            'count' => $count,
            'offset' => $offset,
        ]);

        $request = $this->getConnection()->createRequest($this->getFullMethodName('getRegions'), $parameters);

        return $request->make(RegionsListResponse::class);
    }

    /**
     * @param integer $countryId
     * @param integer|null $regionId
     * @param string|null $searchBy
     * @param integer|null $count
     * @param integer|null $offset
     * @return CitiesListResponse
     * @throws \Exception
     * @throws \VkApi\Exception\Api\TooManyRequestsException
     */
    public function getCities($countryId, $regionId = null, $searchBy = null, $count = null, $offset = null)
    {
        $parameters = $this->prepareParameters([
            'country_id' => $countryId,
            'region_id' => $regionId,
            'q' => $searchBy,
            'count' => $count,
            'offset' => $offset,
        ]);

        $request = $this->getConnection()->createRequest($this->getFullMethodName('getCities'), $parameters);

        return $request->make(CitiesListResponse::class);
    }

    /**
     * @param array $ids
     * @return \VkApi\Response\CitiesListResponse
     * @throws \Exception
     * @throws \VkApi\Exception\Api\TooManyRequestsException
     */
    public function getCitiesById($ids)
    {
        $parameters = $this->prepareParameters([
            'city_ids' => implode(',', $this->ensureIsArray($ids)),
        ]);

        $request = $this->getConnection()->createRequest($this->getFullMethodName('getCitiesById'), $parameters);

        return $request->make(SpecificCitiesListResponse::class);
    }
}