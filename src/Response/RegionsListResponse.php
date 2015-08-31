<?php

namespace VkApi\Response;

use VkApi\Entity\Region;
use VkApi\Response\Traits\WithCountAll;

class RegionsListResponse extends ListResponse
{
    use WithCountAll;

    /**
     * @param $class
     * @return Region[]
     */
    public function getItems($class = Region::class)
    {
        return parent::getItems($class);
    }

}