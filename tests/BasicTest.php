<?php

namespace VkApi\Tests;

require './vendor/autoload.php';

use VkApi\Connection;

class BasicTest extends \PHPUnit_Framework_TestCase
{
    /** @var Connection */
    protected $connection = null;

    protected function setUp()
    {
        $credentialsFilePath = './tests/credentials.json';
        if (!file_exists($credentialsFilePath)) {
            file_put_contents($credentialsFilePath, json_encode([
                'appId' => null,
                'appSecret' => '',
                'accessToken' => '',
            ], JSON_PRETTY_PRINT));

            echo 'Credentials file created with empty values.';
        }

        $credentials = json_decode(file_get_contents($credentialsFilePath));
        $this->connection = new Connection($credentials->appId, $credentials->appSecret, $credentials->accessToken);
        $this->connection->setLanguage('en');
    }

    public function testConnection()
    {
        $this->assertInstanceOf(Connection::class, $this->connection);
    }


}