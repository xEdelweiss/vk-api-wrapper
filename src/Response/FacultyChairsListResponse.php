<?php

namespace VkApi\Response;

use VkApi\Entity\FacultyChair;
use VkApi\Response\Traits\WithCountAll;

/**
 * Class CountriesListResponse
 * @package VkApi\Response
 *
 * @method FacultyChair[] getItems
 */
class FacultyChairsListResponse extends ListResponse
{
    use WithCountAll;

    protected $entityClass = FacultyChair::class;

}