<?php

namespace VkApi\Response;

use anlutro\cURL\Response;
use VkApi\Exception\Api\Exception as ApiException;
use VkApi\Exception\HttpException;
use VkApi\JsonWrapper;
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
        $this->parsedResponse = new JsonWrapper($this->rawResponse->body);
        $this->request = $request;

        $this->exceptionIfError();
    }

    /**
     * @return BasicRequest
     */
    public function getRequest()
    {
        return $this->request;
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

    /**
     * @return $this
     * @throws ApiException
     * @throws HttpException
     */
    protected function exceptionIfError()
    {
        if ($this->rawResponse->statusCode !== 200) {
            throw new HttpException($this->request, $this);
        }

        if (isset($this->getParsedResponse()->error)) {
            throw ApiException::factory($this->request, $this);
        }

        return $this;
    }
}