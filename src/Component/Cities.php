<?php

namespace VkApi\Component;

use VkApi\Response\CitiesListResponse;
use VkApi\Response\SpecificCitiesListResponse;

class Cities extends BasicComponent
{
    static $prefix = 'database';

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
    public function get($countryId, $regionId = null, $searchBy = null, $count = null, $offset = null)
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

    /**
     * @param $id
     * @return \VkApi\Entity\Country
     */
    public function getCity($id)
    {
        $result = $this->getCitiesById([$id]);

        return $result->getFirstItem();
    }
}