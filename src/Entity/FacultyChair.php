<?php

namespace VkApi\Entity;

use VkApi\Entity\Traits\DisableExtendedEntityRequest;
use VkApi\Entity\Traits\WithId;
use VkApi\Entity\Traits\WithTitle;

class FacultyChair extends BasicEntity
{
    use WithId, WithTitle, DisableExtendedEntityRequest;

    public function getFacultyId()
    {
        return $this->getOriginalRequestParameter('faculty_id');
    }

    /**
     * @return null|Faculty
     */
    public function getFaculty()
    {
        $facultyId = $this->getFacultyId();

        // FIXME replace with call to component
        return $facultyId
            ? $this->getConnection()->api->database->getFaculties($facultyId)->getFirstItem()
            : null;
    }
}