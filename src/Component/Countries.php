<?php

namespace VkApi\Component;

use VkApi\Response\CountriesListResponse;

class Countries extends BasicComponent
{
    static $prefix = 'database';

    public function get($needAll = null, $code = null, $count = null, $offset = null)
    {
        $parameters = $this->prepareParameters([
            'need_all' => $needAll,
            'code' => $this->ensureIsArray($code),
            'count' => $count,
            'offset' => $offset,
        ]);

        $request = $this->getConnection()->createRequest($this->getFullMethodName('getCountries'), $parameters);

        return $request->make(CountriesListResponse::class);
    }
}