<?php

namespace VkApi\Response;

use VkApi\Entity\Country;
use VkApi\Response\Traits\WithCountAll;

/**
 * Class CountriesListResponse
 * @package VkApi\Response
 *
 * @method Country[] getItems
 */
class CountriesListResponse extends ListResponse
{
    use WithCountAll;

    protected $entityClass = Country::class;

}