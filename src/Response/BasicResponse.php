<?php

namespace VkApi\Response;

use anlutro\cURL\Response;
use VkApi\Exception\ApiException;
use VkApi\Exception\HttpException;
use VkApi\Request\BasicRequest;

class BasicResponse
{
    protected $rawResponse;

    protected $parsedResponse;

    /**
     * @var BasicRequest
     */
    private $request;

    /**
     * Response constructor.
     * @param Response $response
     * @param BasicRequest $request
     */
    public function __construct(Response $response, BasicRequest $request)
    {
        $this->rawResponse = $response;
        $this->parsedResponse = json_decode($this->rawResponse->body);
        $this->request = $request;
    }

    public function exceptionIfError()
    {
        if ($this->rawResponse->statusCode !== 200) {
            throw new HttpException($this->request, $this);
        }

        if (isset($this->getParsedResponse()->error)) {
            throw new ApiException($this->request, $this);
        }
    }

    /**
     * @return Response
     */
    public function getRawResponse()
    {
        return $this->rawResponse;
    }

    public function getParsedResponse()
    {
        return $this->parsedResponse;
    }
}