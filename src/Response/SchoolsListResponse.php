<?php

namespace VkApi\Response;

use VkApi\Entity\School;
use VkApi\Response\Traits\WithCountAll;

/**
 * Class CountriesListResponse
 * @package VkApi\Response
 *
 * @method School[] getItems
 */
class SchoolsListResponse extends ListResponse
{
    use WithCountAll;

    protected $entityClass = School::class;

}