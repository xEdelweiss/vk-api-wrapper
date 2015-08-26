<?php

namespace VkApi;

use VkApi\Component\Messages;
use VkApi\Component\Users;
use VkApi\Request\BasicRequest;

/**
 * Class Connection
 * @package VkApi
 *
 * @property Messages $messages Messages Component
 * @property Users $users Users Component
 */
class Connection
{
    protected $appId;
    protected $appSecret;
    protected $accessToken;
    protected $version = '5.37';
    protected $apiEntryPoint = 'https://api.vk.com/method/';

    private $instantiatedComponents;

    /**
     * Connection constructor.
     *
     * @param int $appId
     * @param string $appSecret
     * @param string $accessToken
     */
    public function __construct($appId, $appSecret, $accessToken)
    {
        $this->appId = $appId;
        $this->appSecret = $appSecret;
        $this->accessToken = $accessToken;
    }

    /**
     * @param $name
     * @return mixed
     */
    function __get($name)
    {
        $componentName = ucfirst($name);

        if (!isset($this->instantiatedComponents[$componentName])) {
            $className =  '\\' . __NAMESPACE__ . '\\Component\\' . $componentName;

            $this->instantiatedComponents[$componentName] = new $className($this);
        }

        return $this->instantiatedComponents[$componentName];
    }

    /**
     * @return int
     */
    public function getAppId()
    {
        return $this->appId;
    }

    /**
     * @return string
     */
    public function getAppSecret()
    {
        return $this->appSecret;
    }

    /**
     * @return string
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @return string
     */
    public function getApiEntryPoint()
    {
        return $this->apiEntryPoint;
    }

    /**
     * @param $method
     * @param $parameters
     * @param $requestClass
     * @return BasicRequest
     */
    public function createRequest($method, $parameters, $requestClass = BasicRequest::class)
    {
        return new $requestClass($method, $parameters, 'json', $this);
    }
}