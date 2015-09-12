<?php

namespace VkApi\Query;

class UserSearchQuery extends BasicQuery
{
    /** @var string */
    protected $searchFor = null;

    /** @var integer */
    protected $sort = null;

    /** @var integer */
    protected $count = null;

    /** @var integer */
    protected $offset = null;

    /** @var array */
    protected $fields = null;

    /** @var integer */
    protected $city = null;

    /** @var integer */
    protected $country = null;

    /** @var string */
    protected $hometown = null;

    /** @var integer */
    protected $universityCountry = null;

    /** @var integer */
    protected $university = null;

    /** @var integer */
    protected $universityYear = null;

    /** @var integer */
    protected $universityFaculty = null;

    /** @var integer */
    protected $universityChair = null;

    /** @var integer */
    protected $sex = null;

    /** @var integer */
    protected $status = null;

    /** @var integer */
    protected $ageFrom = null;

    /** @var integer */
    protected $ageTo = null;

    /** @var integer */
    protected $birthDay = null;

    /** @var integer */
    protected $birthMonth = null;

    /** @var integer */
    protected $birthYear = null;

    /** @var bool */
    protected $online = null;

    /** @var bool */
    protected $hasPhoto = null;

    /** @var integer */
    protected $schoolCountry = null;

    /** @var integer */
    protected $schoolCity = null;

    /** @var integer */
    protected $schoolClass = null;

    /** @var integer */
    protected $school = null;

    /** @var integer */
    protected $schoolYear = null;

    /** @var string */
    protected $religion = null;

    /** @var string */
    protected $interests = null;

    /** @var string */
    protected $company = null;

    /** @var string */
    protected $position = null;

    /** @var integer */
    protected $groupId = null;

    /** @var array */
    protected $fromList = null;

    /** @var array */
    protected $ensureIsArray = [
        'fields',
        'fromList',
    ];

    /** @var array */
    protected $keyMap = [
        'searchFor' => 'q',
    ];

    /**
     * @return string
     */
    public function getSearchFor()
    {
        return $this->searchFor;
    }

    /**
     * @param string $searchFor
     * @return $this
     */
    public function setSearchFor($searchFor)
    {
        $this->searchFor = $searchFor;
        return $this;
    }

    /**
     * @return int
     */
    public function getSort()
    {
        return $this->sort;
    }

    /**
     * @param int $sort
     * @return $this
     */
    public function setSort($sort)
    {
        $this->sort = $sort;
        return $this;
    }

    /**
     * @return int
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @param int $count
     * @return $this
     */
    public function setCount($count)
    {
        $this->count = $count;
        return $this;
    }

    /**
     * @return int
     */
    public function getOffset()
    {
        return $this->offset;
    }

    /**
     * @param int $offset
     * @return $this
     */
    public function setOffset($offset)
    {
        $this->offset = $offset;
        return $this;
    }

    /**
     * @return array
     */
    public function getFields()
    {
        return $this->ensureIsArray($this->fields);
    }

    /**
     * @param array $fields
     * @return $this
     */
    public function setFields($fields)
    {
        $this->fields = $this->ensureIsArray($fields);
        return $this;
    }

    /**
     * @return integr
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param integr $city
     * @return $this
     */
    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return int
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param int $country
     * @return $this
     */
    public function setCountry($country)
    {
        $this->country = $country;
        return $this;
    }

    /**
     * @return string
     */
    public function getHometown()
    {
        return $this->hometown;
    }

    /**
     * @param string $hometown
     * @return $this
     */
    public function setHometown($hometown)
    {
        $this->hometown = $hometown;
        return $this;
    }

    /**
     * @return int
     */
    public function getUniversityCountry()
    {
        return $this->universityCountry;
    }

    /**
     * @param int $universityCountry
     * @return $this
     */
    public function setUniversityCountry($universityCountry)
    {
        $this->universityCountry = $universityCountry;
        return $this;
    }

    /**
     * @return int
     */
    public function getUniversity()
    {
        return $this->university;
    }

    /**
     * @param int $university
     * @return $this
     */
    public function setUniversity($university)
    {
        $this->university = $university;
        return $this;
    }

    /**
     * @return int
     */
    public function getUniversityYear()
    {
        return $this->universityYear;
    }

    /**
     * @param int $universityYear
     * @return $this
     */
    public function setUniversityYear($universityYear)
    {
        $this->universityYear = $universityYear;
        return $this;
    }

    /**
     * @return int
     */
    public function getUniversityFaculty()
    {
        return $this->universityFaculty;
    }

    /**
     * @param int $universityFaculty
     * @return $this
     */
    public function setUniversityFaculty($universityFaculty)
    {
        $this->universityFaculty = $universityFaculty;
        return $this;
    }

    /**
     * @return int
     */
    public function getUniversityChair()
    {
        return $this->universityChair;
    }

    /**
     * @param int $universityChair
     * @return $this
     */
    public function setUniversityChair($universityChair)
    {
        $this->universityChair = $universityChair;
        return $this;
    }

    /**
     * @return int
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * @param int $sex
     * @return $this
     */
    public function setSex($sex)
    {
        $this->sex = $sex;
        return $this;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param int $status
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return int
     */
    public function getAgeFrom()
    {
        return $this->ageFrom;
    }

    /**
     * @param int $ageFrom
     * @return $this
     */
    public function setAgeFrom($ageFrom)
    {
        $this->ageFrom = $ageFrom;
        return $this;
    }

    /**
     * @return int
     */
    public function getAgeTo()
    {
        return $this->ageTo;
    }

    /**
     * @param int $ageTo
     * @return $this
     */
    public function setAgeTo($ageTo)
    {
        $this->ageTo = $ageTo;
        return $this;
    }

    /**
     * @return int
     */
    public function getBirthDay()
    {
        return $this->birthDay;
    }

    /**
     * @param int $birthDay
     * @return $this
     */
    public function setBirthDay($birthDay)
    {
        $this->birthDay = $birthDay;
        return $this;
    }

    /**
     * @return int
     */
    public function getBirthMonth()
    {
        return $this->birthMonth;
    }

    /**
     * @param int $birthMonth
     * @return $this
     */
    public function setBirthMonth($birthMonth)
    {
        $this->birthMonth = $birthMonth;
        return $this;
    }

    /**
     * @return int
     */
    public function getBirthYear()
    {
        return $this->birthYear;
    }

    /**
     * @param int $birthYear
     * @return $this
     */
    public function setBirthYear($birthYear)
    {
        $this->birthYear = $birthYear;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isOnline()
    {
        return $this->online;
    }

    /**
     * @param boolean $online
     * @return $this
     */
    public function setOnline($online)
    {
        $this->online = $online;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isHasPhoto()
    {
        return $this->hasPhoto;
    }

    /**
     * @param boolean $hasPhoto
     * @return $this
     */
    public function setHasPhoto($hasPhoto)
    {
        $this->hasPhoto = $hasPhoto;
        return $this;
    }

    /**
     * @return int
     */
    public function getSchoolCountry()
    {
        return $this->schoolCountry;
    }

    /**
     * @param int $schoolCountry
     * @return $this
     */
    public function setSchoolCountry($schoolCountry)
    {
        $this->schoolCountry = $schoolCountry;
        return $this;
    }

    /**
     * @return int
     */
    public function getSchoolCity()
    {
        return $this->schoolCity;
    }

    /**
     * @param int $schoolCity
     * @return $this
     */
    public function setSchoolCity($schoolCity)
    {
        $this->schoolCity = $schoolCity;
        return $this;
    }

    /**
     * @return int
     */
    public function getSchoolClass()
    {
        return $this->schoolClass;
    }

    /**
     * @param int $schoolClass
     * @return $this
     */
    public function setSchoolClass($schoolClass)
    {
        $this->schoolClass = $schoolClass;
        return $this;
    }

    /**
     * @return int
     */
    public function getSchool()
    {
        return $this->school;
    }

    /**
     * @param int $school
     * @return $this
     */
    public function setSchool($school)
    {
        $this->school = $school;
        return $this;
    }

    /**
     * @return int
     */
    public function getSchoolYear()
    {
        return $this->schoolYear;
    }

    /**
     * @param int $schoolYear
     * @return $this
     */
    public function setSchoolYear($schoolYear)
    {
        $this->schoolYear = $schoolYear;
        return $this;
    }

    /**
     * @return string
     */
    public function getReligion()
    {
        return $this->religion;
    }

    /**
     * @param string $religion
     * @return $this
     */
    public function setReligion($religion)
    {
        $this->religion = $religion;
        return $this;
    }

    /**
     * @return string
     */
    public function getInterests()
    {
        return $this->interests;
    }

    /**
     * @param string $interests
     * @return $this
     */
    public function setInterests($interests)
    {
        $this->interests = $interests;
        return $this;
    }

    /**
     * @return string
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param string $company
     * @return $this
     */
    public function setCompany($company)
    {
        $this->company = $company;
        return $this;
    }

    /**
     * @return string
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param string $position
     * @return $this
     */
    public function setPosition($position)
    {
        $this->position = $position;
        return $this;
    }

    /**
     * @return int
     */
    public function getGroupId()
    {
        return $this->groupId;
    }

    /**
     * @param int $groupId
     * @return $this
     */
    public function setGroupId($groupId)
    {
        $this->groupId = $groupId;
        return $this;
    }

    /**
     * @return array
     */
    public function getFromList()
    {
        return $this->ensureIsArray($this->fromList);
    }

    /**
     * @param array $fromList
     * @return $this
     */
    public function setFromList($fromList)
    {
        $this->fromList = $this->ensureIsArray($fromList);
        return $this;
    }

    /**
     * @param $item
     * @return $this
     */
    public function addToFromList($item)
    {
        $fromList = $this->getFromList();

        if (!in_array($item, $fromList)) {
            $fromList[] = $item;
            $this->setFromList($fromList);
        }

        return $this;
    }

    /**
     * @param $item
     * @return $this
     */
    public function removeFromToList($item)
    {
        $fromList = $this->getFromList();
        $fromList = array_diff($fromList, [$item]);
        $this->setFromList(array_values($fromList));

        return $this;
    }

    /**
     * @return $this
     */
    public function searchAmongFriends()
    {
        $this->addToFromList('friends');
        return $this;
    }

    /**
     * @return $this
     */
    public function searchAmongSubscriptions()
    {
        $this->addToFromList('subscriptions');
        return $this;
    }
}