<?php

namespace VkApi\Response;

use VkApi\Entity\BasicEntity;
use VkApi\Utils;

class ListResponse extends BasicResponse
{
    protected $entityClass = BasicEntity::class;

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
    public function getItems($class = null)
    {
        $class = $class ?: $this->entityClass;

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
     * @param $propertyName
     * @param $value
     * @return bool|mixed
     */
    public function getIndexOf($propertyName, $value)
    {
        /** @var BasicEntity[] $items */
        $items = $this->getItems();
        $getter = 'get' . ucfirst($propertyName);

        foreach ($items as $index => $item) {
            if (method_exists($item, $getter) && $item->{$getter}() == $value) {
                return $index;
            } elseif ($item->getRawValue($propertyName, false) == $value) {
                return $index;
            }
        }

        return false;
    }

    /**
     * @param $propertyNames
     * @return array
     */
    public function getColumn(...$propertyNames)
    {
        $result = [];
        /** @var BasicEntity[] $items */
        $items = $this->getItems();

        foreach ($items as $index => $item) {
            $resultItem = [];

            foreach($propertyNames as $propertyName) {
                $getters = [
                    'get' . ucfirst($propertyName),
                    'is' . ucfirst($propertyName),
                ];

                foreach ($getters as $getter) {
                    if (method_exists($item, $getter)) {
                        $resultItem[$propertyName] = $item->{$getter}();
                        continue(2);
                    }
                }

                $resultItem[$propertyName] = $item->getRawValue($propertyName);
            }

            $result[] = $resultItem;
        }

        return $result;
    }

    /**
     * @param $array
     * @param $class
     * @return array
     */
    protected function arrayToObjectOfClass($array, $class)
    {
        $connection = $this->getRequest()->getConnection();

        return Utils::convertArrayToArrayOfObjects($array, $class, $this->getRequest()->getParameters(), $connection);
    }
}