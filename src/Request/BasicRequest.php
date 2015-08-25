<?php

namespace VkApi\Request;

use anlutro\cURL\cURL;
use VkApi\Response\BasicResponse;

class BasicRequest
{
    private $method;
    private $parameters;
    private $format;
    private $entryPoint;

    /**
     * Request constructor.
     * @param $method
     * @param array $parameters
     * @param $format
     */
    public function __construct($method, array $parameters, $format, $entryPoint)
    {
        $this->method = $method;
        $this->parameters = $parameters;
        $this->format = $format;
        $this->entryPoint = $entryPoint;
    }

    public function make($responseClass = BasicResponse::class)
    {
        $curl = new cURL();
        $url = $curl->buildUrl($this->entryPoint . $this->method . '.' . $this->format, $this->parameters);

        return new $responseClass($curl->get($url), $this);
    }

    /**
     * @return mixed
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @return array
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * @return mixed
     */
    public function getFormat()
    {
        return $this->format;
    }

}