<?php

namespace VkApi\Exception;

use Exception;
use VkApi\Request\BasicRequest;
use VkApi\Response\BasicResponse;

class ApiException extends Exception
{
    /**
     * @var array
     */
    protected $request;

    /**
     * @var BasicResponse
     */
    protected $response;

    public function __construct(BasicRequest $request, BasicResponse $response, Exception $previous = null)
    {
        $this->request = $request;
        $this->response = $response;

        $parsedResponse = $response->getParsedResponse();

        parent::__construct($parsedResponse->error->error_msg, $parsedResponse->error->error_code, $previous);
    }

    /**
     * @return mixed
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @return BasicResponse
     */
    public function getResponse()
    {
        return $this->response;
    }
}