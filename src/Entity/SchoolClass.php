<?php

namespace VkApi\Entity;

use VkApi\Connection;
use VkApi\Entity\Traits\DisableExtendedEntityRequest;
use VkApi\Entity\Traits\WithId;

class SchoolClass extends BasicEntity
{
    use WithId, DisableExtendedEntityRequest;

    public function __construct($data, $originalRequestParameters, Connection $connection)
    {
        $modifiedData = [
            'id' => $data[0],
            'title' => $data[1]
        ];

        parent::__construct((object)$modifiedData, $originalRequestParameters, $connection);
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->getRawValue('title');
    }
}