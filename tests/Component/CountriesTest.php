<?php

namespace VkApi\Tests\Component;

use VkApi\Entity\Country;
use VkApi\Response\CountriesListResponse;
use VkApi\Tests\BasicTest;

class CountriesTest extends BasicTest
{
    public function getDataProvider()
    {
        return [
            // $needAll = null, $code = null, $count = null, $offset = null
            [[null, null, 3, null], 3, 18, ['Ukraine', 'Belarus', 'Russia']],
            [[null, null, 3, 2], 3, 18, ['Belarus', 'Kazakhstan', 'Azerbaijan']],
            [[1, null, 3, null], 3, 234, ['Afghanistan', 'Albania', 'Algeria']],
            [[1, null, 3, 2], 3, 234, ['Algeria', 'American Samoa', 'Andorra']],
            [[null, ['UA', 'BY', 'LT'], null, null], 3, 3, ['Ukraine', 'Belarus', 'Lithuania']],
            [[1, ['UA', 'BY', 'LT'], null, null], 3, 3, ['Ukraine', 'Belarus', 'Lithuania']],
            [[null, 'UA,BY,LT', null, null], 3, 3, ['Ukraine', 'Belarus', 'Lithuania']],
        ];
    }

    public function getCountriesByIdDataProvider()
    {
        return [
            [[[2,3]], 2, 18, ['Ukraine', 'Belarus']],
            [[[10]], 1, 18, ['Canada']],
        ];
    }

    public function getCountryDataProvider()
    {
        return [
            [[2], 2, 'Ukraine'],
            [[10], 10, 'Canada'],
        ];
    }

    /**
     * @param $params
     * @param $expectedCount
     * @param $expectedCountAll
     * @param $expectedTitles
     *
     * @dataProvider getDataProvider
     */
    public function testGet($params, $expectedCount, $expectedCountAll, $expectedTitles)
    {
        /** @var CountriesListResponse $response */
        $response = call_user_func_array([$this->connection->countries, 'get'], $params);

        $this->assertInstanceOf(CountriesListResponse::class, $response);
        $this->assertEquals($expectedCount, $response->getCount());
        $this->assertEquals($expectedCountAll, $response->getCountAll());

        foreach ($expectedTitles as $expectedTitle) {
            $this->assertNotFalse($response->getIndexOf('title', $expectedTitle), sprintf('Unable to find [%s] in [%s]', $expectedTitle, json_encode($response->getColumn('title'))));
        }
    }

    /**
     * @param $params
     * @param $expectedCount
     * @param $expectedCountAll
     * @param $expectedTitles
     *
     * @dataProvider getCountriesByIdDataProvider
     */
    public function testGetCountriesById($params, $expectedCount, $expectedCountAll, $expectedTitles)
    {
        /** @var CountriesListResponse $response */
        $response = call_user_func_array([$this->connection->countries, 'getCountriesById'], $params);

        $this->assertInstanceOf(CountriesListResponse::class, $response);
        $this->assertEquals($expectedCount, $response->getCount(), 'Wrong expected count');
        $this->assertEquals($expectedCountAll, $response->getCountAll(), 'Wrong expected overall count');

        foreach ($expectedTitles as $expectedTitle) {
            $this->assertNotFalse($response->getIndexOf('title', $expectedTitle), sprintf('Unable to find [%s] in [%s]', $expectedTitle, json_encode($response->getColumn('title'))));
        }
    }

    /**
     * @param $params
     * @param $expectedId
     * @param $expectedTitle
     *
     * @dataProvider getCountryDataProvider
     */
    public function testGetCountry($params, $expectedId, $expectedTitle)
    {
        /** @var Country $response */
        $response = call_user_func_array([$this->connection->countries, 'getCountry'], $params);

        $this->assertInstanceOf(Country::class, $response);
        $this->assertEquals($expectedId, $response->getId());
        $this->assertEquals($expectedTitle, $response->getTitle());
    }
}
