<?php

namespace IntellirentSDK\Traits;

trait Validator
{
    /**
     * Validate URL
     * 
     * @param string $url
     * @return bool
     */
    public function isValidUrl(string $url): bool
    {
        return filter_var($url, FILTER_VALIDATE_URL);
    }

    /**
     * Validate JSON string
     * 
     * @param string $json
     * @return bool
     */
    public function isValidJSON(string $json): bool
    {
        json_decode($json);

        return (json_last_error() === JSON_ERROR_NONE);
    }

    /**
     * Validate if this class has property set
     * 
     * @param void
     * @return bool
     */
    public function isPropertySet($property): bool
    {
        return null !== $this->$property;
    }

    /**
     * Validate if $data has this $key
     * 
     * @param array $data
     * @param string $key
     * @return bool
     */
    public function hasKey(array $data, string $key): bool
    {
        return isset($data[$key]);
    }
}