<?php

namespace VkApi\Response;

use VkApi\Entity\Region;
use VkApi\Response\Traits\WithCountAll;

/**
 * Class RegionsListResponse
 * @package VkApi\Response
 *
 * @method Region[] getItems
 */
class RegionsListResponse extends ListResponse
{
    use WithCountAll;

    protected $entityClass = Region::class;

}