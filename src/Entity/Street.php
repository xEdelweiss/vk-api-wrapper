<?php

namespace VkApi\Entity;

use VkApi\Entity\Traits\DisableExtendedEntityRequest;
use VkApi\Entity\Traits\WithId;
use VkApi\Entity\Traits\WithTitle;

class Street extends BasicEntity
{
    use WithId, WithTitle, DisableExtendedEntityRequest;
}