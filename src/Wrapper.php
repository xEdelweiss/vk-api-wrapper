<?php

namespace VkApi;

use VkApi\Component\Messages;
use VkApi\Request\BasicRequest;

/**
 * Class Wrapper
 * @package VkApi
 *
 * @property Messages $messages Messages Component
 */
class Wrapper
{
    const API_ENTRY_POINT = 'https://api.vk.com/method/';

    protected $appId;
    protected $appSecret;
    protected $accessToken;
    protected $version = '5.37';

    private $instantiatedComponents;

    /**
     * Wrapper constructor.
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

    public function createRequest($method, $parameters, $format = 'json')
    {
        $systemParameters = [
            'v' => $this->version,
            'access_token' => $this->accessToken,
        ];

        return new BasicRequest($method, array_merge($systemParameters, $parameters), $format, static::API_ENTRY_POINT);
    }
}