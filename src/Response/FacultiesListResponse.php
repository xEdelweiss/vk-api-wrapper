<?php

namespace VkApi\Response;

use VkApi\Entity\Faculty;
use VkApi\Response\Traits\WithCountAll;

/**
 * Class CountriesListResponse
 * @package VkApi\Response
 *
 * @method Faculty[] getItems
 */
class FacultiesListResponse extends ListResponse
{
    use WithCountAll;

    protected $entityClass = Faculty::class;

}