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
        $credentials = json_decode(file_get_contents('./tests/credentials.json'));
        $this->connection = new Connection($credentials->appId, $credentials->appSecret, $credentials->accessToken);
        $this->connection->setLanguage('en');
    }

    public function testConnection()
    {
        $this->assertInstanceOf(Connection::class, $this->connection);
    }


}