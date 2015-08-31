<?php

namespace VkApi\Response;

use VkApi\Entity\BasicEntity;

class ListResponse extends BasicResponse
{
    /**
     * @return int
     *
     * TODO count without converting
     */
    public function getCount()
    {
        return count($this->getItems());
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
     * @return BasicEntity
     *
     * TODO check first element existence
     * TODO don't convert all elements
     */
    public function getFirstItem()
    {
        return $this->getItems()[0];
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