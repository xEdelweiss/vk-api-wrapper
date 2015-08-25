<?php

namespace VkApi\Response;

class ListResponse extends BasicResponse
{
    public function getCount()
    {
        return $this->getParsedResponse()->response->count;
    }

    public function getItems()
    {
        return $this->getParsedResponse()->response->items;
    }
}