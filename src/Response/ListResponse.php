<?php

namespace VkApi\Response;

use VkApi\Entity\BasicEntity;

class ListResponse extends BasicResponse
{
    /**
     * @return int
     */
    public function getCount()
    {
        return $this->getParsedResponse()->response->count;
    }

    /**
     * @param $class
     * @return BasicEntity[]
     */
    public function getItems($class = BasicEntity::class)
    {
        return $this->arrayToObjectOfClass($this->getParsedResponse()->response->items, $class);
    }

    /**
     * @param $array
     * @param $class
     * @return array
     */
    protected function arrayToObjectOfClass($array, $class)
    {
        $connection = $this->getRequest()->getConnection();

        return array_map(function($item) use ($class, $connection){
            return new $class($item, $this->getRequest()->getParameters(), $connection);
        }, $array);
    }
}