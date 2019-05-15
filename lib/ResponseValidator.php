<?php

namespace IntellirentSDK;

use IntellirentSDK\Exceptions\SerializationException;

class ResponseValidator
{
    /**
     * Validate Response
     * 
     * @param object $response - response object, probably a JSON object
     * @param array $expected_properties - expected object properties
     * @throws SerializationException
     */
    public function validate($response, $expected_properties)
    {
        $failed_properties = [];

        foreach ($expected_properties as $property) {
            // check to see if the property exists or is not set
            if (!isset($response->{$property})) {
                // The property exists, but isn't set
                $failed_properties[] = $property;
            }
        }

        // If there are values in the $failed_properties array, throw a SerializationException
        if (!empty($failed_properties)) {
            throw new SerializationException(implode(', ', $failed_properties) . ' were not set correctly');
        }
    }
}