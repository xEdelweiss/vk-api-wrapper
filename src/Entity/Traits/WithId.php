<?php

namespace VkApi\Entity\Traits;

use VkApi\Entity\BasicEntity;

trait WithId
{
    /**
     * @return int
     */
    public function getId()
    {
        /** @var $this BasicEntity */
        return (int) $this->getRawData()->id;
    }
}