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
     * @param bool|null    $needAll  Return a full list of all countries (TRUE) or list of countries near the current user's country (FALSE)
     * @param array|null   $code     Country codes in ISO 3166-1 alpha-2 standard.
     * @param integer|null $count    Number of messages to return.
     * @param integer|null $offset   Offset needed to return a specific subset of messages.
     *
     * @return CountriesListResponse
     *
     * @throws Exception
     * @throws TooManyRequestsException
     */
    public function getCountries($needAll = false, $code = null, $count = null, $offset = null)
    {
        $parameters = $this->prepareParametersFromArguments(['code']);

        return $this->createRequest($parameters)
            ->make(CountriesListResponse::class);
    }

    /**
     * Returns information about countries by their IDs.
     *
     * @param integer|array $countryIds Country IDs
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
     * @param integer       $countryId  Country ID.
     * @param string|null   $searchBy   Search query.
     * @param integer|null  $count      Number of messages to return.
     * @param integer|null  $offset     Offset needed to return a specific subset of messages.
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
     * @param integer       $countryId  Country ID.
     * @param integer|null  $regionId   Region ID.
     * @param string|null   $searchBy   Search query.
     * @param integer|null  $count      Number of messages to return.
     * @param integer|null  $offset     Offset needed to return a specific subset of messages.
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
     * @param integer|array $cityIds City IDs.
     *
     * @return CitiesListResponse
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
     * @param integer|array $streetIds Street IDs.
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
     * @param integer       $cityId     City ID.
     * @param integer|null  $countryId  Country ID.
     * @param string|null   $searchBy   Search query.
     * @param integer|null  $count      Number of messages to return.
     * @param integer|null  $offset     Offset needed to return a specific subset of messages.
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
     * @param integer       $cityId    City ID.
     * @param string|null   $searchBy  Search query.
     * @param integer|null  $count     Number of messages to return.
     * @param integer|null  $offset    Offset needed to return a specific subset of messages.
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
     * @param integer $countryId Country ID.
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
     * @param integer       $universityId  University ID.
     * @param integer|null  $count         Number of messages to return.
     * @param integer|null  $offset        Offset needed to return a specific subset of messages.
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
     * @param integer       $facultyId  Faculty ID.
     * @param integer|null  $count      Number of messages to return.
     * @param integer|null  $offset     Offset needed to return a specific subset of messages.
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