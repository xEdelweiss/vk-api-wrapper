<?php

namespace VkApi\Exception;

use Exception;

class InvalidEnumValueException extends Exception
{
    /**
     * @param string $passed
     * @param array $possible
     * @param string $message
     * @param Exception|null $previous
     */
    public function __construct($passed, $possible, $message = "", Exception $previous = null)
    {
        $code = 0;
        $message = $message ?: "Invalid value [{$passed}] passed. Possible values: " . json_encode(array_values($possible));

        parent::__construct($message, $code, $previous);
    }

}