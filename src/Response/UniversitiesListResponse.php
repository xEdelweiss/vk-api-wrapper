<?php

namespace VkApi\Response;

use VkApi\Entity\University;
use VkApi\Response\Traits\WithCountAll;

/**
 * Class CountriesListResponse
 * @package VkApi\Response
 *
 * @method University[] getItems
 */
class UniversitiesListResponse extends ListResponse
{
    use WithCountAll;

    protected $entityClass = University::class;

}