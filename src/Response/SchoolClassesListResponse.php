<?php

namespace VkApi\Response;

use VkApi\Entity\SchoolClass;
use VkApi\Response\Traits\WithCountAll;

/**
 * Class CountriesListResponse
 * @package VkApi\Response
 */
class SchoolClassesListResponse extends ListResponse
{
    use WithCountAll;

    protected $entityClass = SchoolClass::class;

    /**
     * @param $class
     * @return SchoolClass[]
     */
    public function getItems($class = SchoolClass::class)
    {
        return $this->arrayToObjectOfClass($this->getParsedResponse()->response, $class);
    }

}