<?php

namespace VkApi\Query;

use ReflectionProperty;
use VkApi\Utils;

class BasicQuery
{
    /** @var array */
    protected $ensureIsArray = [];

    /** @var array */
    protected $keyMap = [];

    public function getQueryParameters()
    {
        $parameters = [];

        $reflection = new \ReflectionObject($this);
        $reflectionParameters = $reflection->getProperties(ReflectionProperty::IS_PROTECTED);

        $ensureIsArray = $this->ensureIsArray;
        $keyMap = $this->keyMap;

        foreach ($reflectionParameters as $id => $reflectionParameter)
        {
            $originalKey = $reflectionParameter->getName();

            if (in_array($originalKey, ['ensureIsArray', 'keyMap'])) {
                continue;
            }

            $key = strtolower(preg_replace(
                '/([a-z])([A-Z])/',
                '$1_$2',
                Utils::getFrom($keyMap, $originalKey, $originalKey)
            ));

            // will fail on required values
            // but without them you cannot get here
            $parameters[$key] = method_exists($this, 'is'.ucfirst($originalKey))
                ? $this->{'is'.ucfirst($originalKey)}()
                : $this->{'get'.ucfirst($originalKey)}();

            if (in_array($originalKey, $ensureIsArray)) {
                $parameters[$key] = $this->ensureIsArray($parameters[$key]);
            }
        }

        return array_filter($parameters);
    }

    /**
     * @param $array
     * @return array
     */
    protected function ensureIsArray($array)
    {
        if (is_null($array)) {
            return [];
        }

        if (is_scalar($array)) {
            return [$array];
        }

        return $array;
    }
}