<?php

namespace VkApi\Entity;

use VkApi\Connection;
use VkApi\Entity\Traits\DisableExtendedEntityRequest;
use VkApi\Entity\Traits\WithId;
use VkApi\Entity\Traits\WithTitle;

class SchoolClass extends BasicEntity
{
    use WithId, WithTitle, DisableExtendedEntityRequest;

    public function __construct($data, $originalRequestParameters, Connection $connection)
    {
        $modifiedData = [
            'id' => $data[0],
            'title' => $data[1]
        ];

        parent::__construct((object)$modifiedData, $originalRequestParameters, $connection);
    }
}