<?php

namespace VkApi\Response\Traits;

use VkApi\Response\ListResponse;

trait WithCountAll
{
    /**
     * @return int
     */
    public function getCountAll()
    {
        if (! $this instanceof ListResponse) {
            return 1;
        }

        /** @var $this ListResponse */
        return $this->getParsedResponse()->response->count;
    }
}