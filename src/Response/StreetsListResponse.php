<?php

namespace VkApi\Response;

use VkApi\Entity\Street;

/**
 * Class StreetsListResponse
 * @package VkApi\Response
 */
class StreetsListResponse extends ListResponse
{
    protected $entityClass = Street::class;

    /**
     * @param $class
     * @return Street[]
     */
    public function getItems($class = Street::class)
    {
        return $this->arrayToObjectOfClass($this->getParsedResponse()->response, $class);
    }
}