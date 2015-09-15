<?php

namespace VkApi\Entity;

use VkApi\Entity\Traits\DisableExtendedEntityRequest;
use VkApi\Entity\Traits\WithId;
use VkApi\Entity\Traits\WithTitle;

class Faculty extends BasicEntity
{
    use WithId, WithTitle, DisableExtendedEntityRequest;

    public function getUniversityId()
    {
        return $this->getOriginalRequestParameter('university_id');
    }

    /**
     * @return null|University
     */
    public function getUniversity()
    {
        $universityId = $this->getUniversityId();

        // FIXME replace with call to component
        return $universityId
            ? $this->getConnection()->api->database->getUniversities($universityId)->getFirstItem()
            : null;
    }
}