<?php

namespace VkApi\Request;

use anlutro\cURL\cURL;
use anlutro\cURL\Request;
use VkApi\Connection;
use VkApi\Exception\Api\TooManyRequestsException;
use VkApi\Response\BasicResponse;

class BasicRequest
{
    const SLEEP_TIME = 500000; // 0.5 sec
    const CONNECTION_TIMEOUT = 5;
    const REQUEST_TIMEOUT = 5;
    const RETRIES_COUNT = 5;

    protected $method;
    protected $parameters;
    protected $format;
    protected $connection;

    private $retriesLeft;

    /**
     * Request constructor.
     * @param $method
     * @param array $parameters
     * @param $format
     * @param Connection $connection
     */
    public function __construct($method, array $parameters, $format, Connection $connection)
    {
        $this->method = $method;
        $this->parameters = $parameters;
        $this->format = $format;
        $this->connection = $connection;

        $this->resetRetriesCount();
    }

    /**
     * @param $responseClass
     * @return BasicResponse
     * @throws TooManyRequestsException
     * @throws \Exception
     */
    public function make($responseClass = BasicResponse::class)
    {
        $connection = $this->getConnection();
        $curl = new cURL();
        $url = $curl->buildUrl($connection->getApiEntryPoint() . $this->getMethod() . '.' . $this->getFormat(), $this->getParameters());

        if ($connection->isCached($url)) {
            return $connection->getCached($url);
        }

        try {
            /** @var Request $request */
            $request = $curl->newRequest('get', $url)
                ->setOption(CURLOPT_CONNECTTIMEOUT, static::CONNECTION_TIMEOUT)
                ->setOption(CURLOPT_TIMEOUT, static::REQUEST_TIMEOUT);

            $response = new $responseClass($request->send(), $this);
            $this->resetRetriesCount();
        } catch (TooManyRequestsException $e) {
            if (!$this->canRetry()) {
                throw $e;
            }

            $this->prepareRetry();

            return $this->make($responseClass);
        }

        return $connection->setCached($url, $response);
    }

    /**
     * @return Connection
     */
    public function getConnection()
    {
        return $this->connection;
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
        $systemParameters = [
            'v' => $this->getConnection()->getVersion(),
            'access_token' => $this->getConnection()->getAccessToken(),
        ];

        return array_merge($systemParameters, $this->parameters);
    }

    /**
     * @return mixed
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * Reset left retries count
     */
    private function resetRetriesCount()
    {
        $this->retriesLeft = static::RETRIES_COUNT;
    }

    /**
     * Sleep and decrease left retries
     */
    private function prepareRetry()
    {
        $this->retriesLeft--;
        usleep(static::SLEEP_TIME);
    }

    /**
     * @return bool
     */
    private function canRetry()
    {
        return $this->retriesLeft > 0;
    }

}