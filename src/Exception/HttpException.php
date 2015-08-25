<?php

namespace VkApi\Exception;

use Exception;
use VkApi\Request\BasicRequest;
use VkApi\Response\BasicResponse;

class HttpException extends Exception
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

        parent::__construct($response->getRawResponse()->statusText, $response->getRawResponse()->statusCode, $previous);
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