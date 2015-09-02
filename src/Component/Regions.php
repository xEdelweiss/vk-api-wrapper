<?php

namespace VkApi\Component;

use VkApi\Response\RegionsListResponse;

class Regions extends BasicComponent
{
    static $prefix = 'database';

    /**
     * @param $countryId
     * @param string|null $searchBy
     * @param integer|null $count
     * @param integer|null $offset
     * @return \VkApi\Response\RegionsListResponse
     * @throws \Exception
     * @throws \VkApi\Exception\Api\TooManyRequestsException
     */
    public function get($countryId, $searchBy = null, $count = null, $offset = null)
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
}