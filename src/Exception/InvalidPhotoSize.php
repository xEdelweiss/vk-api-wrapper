<?php

namespace VkApi\Exception;

use Exception;

class InvalidPhotoSize extends Exception
{
    /**
     * @param string $passed
     * @param array $possible
     * @param Exception|null $previous
     */
    public function __construct($passed, $possible, Exception $previous = null)
    {
        $code = 0;
        $message = "Invalid photo size [{$passed}] passed. Possible values: " . json_encode(array_values($possible));

        parent::__construct($message, $code, $previous);
    }

}