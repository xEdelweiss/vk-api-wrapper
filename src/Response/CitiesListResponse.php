<?php

namespace VkApi\Response;

use VkApi\Entity\City;
use VkApi\Response\Traits\WithCountAll;

/**
 * Class CountriesListResponse
 * @package VkApi\Response
 *
 * @method City[] getItems
 */
class CitiesListResponse extends ListResponse
{
    use WithCountAll;

    protected $entityClass = City::class;

}