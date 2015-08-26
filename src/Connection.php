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
     * @var bool
     */
    protected $isCacheEnabled;

    /**
     * @var array
     */
    protected $cache;

    /**
     * Connection constructor.
     *
     * @param int $appId
     * @param string $appSecret
     * @param string $accessToken
     * @param bool $enableCache
     */
    public function __construct($appId, $appSecret, $accessToken, $enableCache = true)
    {
        $this->appId = $appId;
        $this->appSecret = $appSecret;
        $this->accessToken = $accessToken;
        $this->isCacheEnabled = $enableCache;

        $this->initCache();
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
     * @param $key
     * @return bool
     */
    public function isCached($key)
    {
        if (!$this->isCacheEnabled()) {
            return false;
        }

        return isset($this->cache[$key]);
    }

    /**
     * @param $key
     * @return mixed|null
     */
    public function getCached($key)
    {
        if (!$this->isCacheEnabled()) {
            return null;
        }

        return $this->isCached($key) ? $this->cache[$key] : null;
    }

    /**
     * @param $key
     * @param $value
     * @return mixed
     */
    public function setCached($key, $value)
    {
        if (!$this->isCacheEnabled()) {
            return null;
        }

        $this->cache[$key] = $value;

        return $value;
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

    /**
     * @return bool
     */
    protected function isCacheEnabled()
    {
        return $this->isCacheEnabled;
    }

    protected function initCache()
    {
        if (!$this->isCacheEnabled()) {
            return;
        }

        $this->cache = [];
    }
}