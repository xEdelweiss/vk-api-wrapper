<?php

namespace VkApi;

class JsonWrapper
{
    private $data;

    /**
     * JsonWrapper constructor.
     * @param $data
     */
    public function __construct($data)
    {
        if (is_string($data)) {
            $data = json_decode($data, true);
        }

        $this->data = $data;
    }

    /**
     * @param $name
     * @return null|static|self
     */
    public function __get($name)
    {
        if (!isset($this->data[$name])) {
            return null;
        }

        if (is_scalar($this->data[$name])) {
            return $this->data[$name];
        }

        return new static($this->data[$name]);
    }

    /**
     * @param $name
     * @param null $default
     * @return null|static|self
     */
    public function get($name, $default = null)
    {
        if (!isset($this->data[$name])) {
            return $default;
        }

        return $this->__get($name);
    }

    /**
     * @param $name
     * @return null|static|self
     */
    public function getOrEmpty($name)
    {
        return $this->get($name, new static([]));
    }

    /**
     * @return int
     */
    public function getCount()
    {
        return count($this->data);
    }

    /**
     * @return mixed
     */
    public function toArray()
    {
        return $this->data;
    }
}