<?php

namespace VkApi\Entity\Traits;

use VkApi\Entity\BasicEntity;

trait WithTitle
{
    /**
     * @return string
     */
    public function getTitle()
    {
        /** @var $this BasicEntity */
        return $this->getRawValue('title');
    }
}