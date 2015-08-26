<?php

namespace VkApi\Exception\Api;

use VkApi\Exception\Exception as BasicException;
use VkApi\Request\BasicRequest;
use VkApi\Response\BasicResponse;

class Exception extends BasicException
{
    /**
     * @var array
     */
    protected $request;

    /**
     * @var BasicResponse
     */
    protected $response;

    /**
     * @param BasicRequest $request
     * @param BasicResponse $response
     * @return TooManyRequestsException|static
     */
    public static function factory(BasicRequest $request, BasicResponse $response)
    {
        switch ($response->getParsedResponse()->error->error_code) {
            case 6:
                return new TooManyRequestsException($request, $response);
            default:
                return new static($request, $response);
        }
    }

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