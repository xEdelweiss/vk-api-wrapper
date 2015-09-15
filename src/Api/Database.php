<?php

namespace VkApi\Api;

use Exception;
use VkApi\Exception\Api\TooManyRequestsException;
use VkApi\Response\CitiesListResponse;
use VkApi\Response\CountriesListResponse;
use VkApi\Response\FacultiesListResponse;
use VkApi\Response\FacultyChairsListResponse;
use VkApi\Response\RegionsListResponse;
use VkApi\Response\SchoolClassesListResponse;
use VkApi\Response\SchoolsListResponse;
use VkApi\Response\SpecificCitiesListResponse;
use VkApi\Response\SpecificCountriesListResponse;
use VkApi\Response\StreetsListResponse;
use VkApi\Response\UniversitiesListResponse;

/**
 * Class Database
 * @package VkApi\Api
 */
class Database extends BasicApi
{
    /**
     * Returns a list of countries.
     *
     * @param bool|null $needAll
     * @param array|null $code
     * @param integer|null $count
     * @param integer|null $offset
     *
     * @return CountriesListResponse
     *
     * @throws Exception
     * @throws TooManyRequestsException
     */
    public function getCountries($needAll = null, $code = null, $count = null, $offset = null)
    {
        $parameters = $this->prepareParametersFromArguments(['code']);

        return $this->createRequest($parameters)
            ->make(CountriesListResponse::class);
    }

    /**
     * Returns information about countries by their IDs.
     *
     * @param integer|array $countryIds
     *
     * @return CountriesListResponse
     *
     * @throws Exception
     * @throws TooManyRequestsException
     */
    public function getCountriesById($countryIds)
    {
        $parameters = $this->prepareParametersFromArguments(['countryIds']);

        return $this->createRequest($parameters)
            ->make(SpecificCountriesListResponse::class);
    }

    /**
     * Returns a list of regions.
     *
     * @param integer $countryId
     * @param string|null $searchBy
     * @param integer|null $count
     * @param integer|null $offset
     *
     * @return RegionsListResponse
     *
     * @throws Exception
     * @throws TooManyRequestsException
     */
    public function getRegions($countryId, $searchBy = null, $count = null, $offset = null)
    {
        $parameters = $this->prepareParametersFromArguments([], ['searchBy' => 'q']);

        return $this->createRequest($parameters)
            ->make(RegionsListResponse::class);
    }

    /**
     * Returns a list of cities.
     *
     * @param integer $countryId
     * @param integer|null $regionId
     * @param string|null $searchBy
     * @param integer|null $count
     * @param integer|null $offset
     *
     * @return CitiesListResponse
     *
     * @throws Exception
     * @throws TooManyRequestsException
     */
    public function getCities($countryId, $regionId = null, $searchBy = null, $count = null, $offset = null)
    {
        $parameters = $this->prepareParametersFromArguments([], ['searchBy' => 'q']);

        return $this->createRequest($parameters)
            ->make(CitiesListResponse::class);
    }

    /**
     * Returns information about cities by their IDs.
     *
     * @param array $cityIds
     *
     * @return \VkApi\Response\CitiesListResponse
     *
     * @throws Exception
     * @throws TooManyRequestsException
     */
    public function getCitiesById($cityIds)
    {
        $parameters = $this->prepareParametersFromArguments(['cityIds']);

        return $this->createRequest($parameters)
            ->make(SpecificCitiesListResponse::class);
    }

    /**
     * Returns information about streets by their IDs.
     *
     * @param $streetIds
     *
     * @return StreetsListResponse
     *
     * @throws Exception
     * @throws TooManyRequestsException
     */
    public function getStreetsById($streetIds)
    {
        $parameters = $this->prepareParametersFromArguments(['streetIds']);

        return $this->createRequest($parameters)
            ->make(StreetsListResponse::class);
    }

    /**
     * Returns a list of higher education institutions.
     *
     * @param integer $cityId
     * @param integer|null $countryId
     * @param string|null $searchBy
     * @param integer|null $count
     * @param integer|null $offset
     *
     * @return \VkApi\Response\UniversitiesListResponse
     *
     * @throws Exception
     * @throws TooManyRequestsException
     *
     * TODO remove countryId?
     */
    public function getUniversities($cityId, $countryId = null, $searchBy = null, $count = null, $offset = null)
    {
        $parameters = $this->prepareParametersFromArguments([], ['searchBy' => 'q']);

        return $this->createRequest($parameters)
            ->make(UniversitiesListResponse::class);
    }

    /**
     * Returns a list of schools.
     *
     * @param integer $cityId
     * @param string|null $searchBy
     * @param integer|null $count
     * @param integer|null $offset
     *
     * @return SchoolsListResponse
     *
     * @throws Exception
     * @throws TooManyRequestsException
     */
    public function getSchools($cityId, $searchBy = null, $count = null, $offset = null)
    {
        $parameters = $this->prepareParametersFromArguments([], ['searchBy' => 'q']);

        return $this->createRequest($parameters)
            ->make(SchoolsListResponse::class);
    }

    /**
     * Returns a list of school classes.
     *
     * @param integer $countryId
     *
     * @return SchoolClassesListResponse
     *
     * @throws Exception
     * @throws TooManyRequestsException
     */
    public function getSchoolClasses($countryId = null)
    {
        $parameters = $this->prepareParametersFromArguments();

        return $this->createRequest($parameters)
            ->make(SchoolClassesListResponse::class);
    }

    /**
     * Returns a list of faculties (i.e., university departments).
     *
     * @param integer $universityId
     * @param integer|null $count
     * @param integer|null $offset
     *
     * @return FacultiesListResponse
     *
     * @throws Exception
     * @throws TooManyRequestsException
     */
    public function getFaculties($universityId, $count = null, $offset = null)
    {
        $parameters = $this->prepareParametersFromArguments();

        return $this->createRequest($parameters)
            ->make(FacultiesListResponse::class);
    }

    /**
     * Returns list of chairs on a specified faculty.
     *
     * @param integer $facultyId
     * @param integer|null $count
     * @param integer|null $offset
     *
     * @return FacultiesListResponse
     *
     * @throws Exception
     * @throws TooManyRequestsException
     */
    public function getChairs($facultyId, $count = null, $offset = null)
    {
        $parameters = $this->prepareParametersFromArguments();

        return $this->createRequest($parameters)
            ->make(FacultyChairsListResponse::class);
    }

}