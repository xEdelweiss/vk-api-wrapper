<?php

namespace VkApi\Component;

use VkApi\Response\RegionsListResponse;

class Regions extends BasicComponent
{
    static $prefix = 'database';

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