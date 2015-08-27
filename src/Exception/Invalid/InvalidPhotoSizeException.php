<?php

namespace VkApi\Exception\Invalid;

use Exception;
use VkApi\Exception\InvalidEnumValueException;

class InvalidPhotoSizeException extends InvalidEnumValueException
{
    /**
     * @param string $passed
     * @param array $possible
     * @param Exception|null $previous
     */
    public function __construct($passed, $possible, Exception $previous = null)
    {
        $message = "Invalid photo size [{$passed}] passed. Possible values: " . json_encode(array_values($possible));

        parent::__construct($passed, $possible, $message, $previous);
    }

}