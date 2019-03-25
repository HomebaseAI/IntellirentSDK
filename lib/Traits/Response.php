<?php

namespace IntellirentSDK\Traits;

use IntellirentSDK\Exceptions\SerializationException;

Trait Response
{
    /**
     * Validate Response
     * @param object $response - response object, probably a JSON object
     * @param array $properites - expected object properties
     * @throws SerializationException
     */
    public function validateResponse(object $response, array $properties): void
    {
        $failedProperties = [];

        foreach ($properties as $property) {
            // check to see if the property exists or is not set
            if (!isset($response->{$property})) {
                // The property exists, but isn't set
                $failedProperties[] = $property;
            }
        }

        // If there are vaues in the $failedProperties array, we need to throw a SerializationException
        if (!empty($failedProperties)) {
            throw new SerializationException(implode(', ', $failedProperties) . ' were not set correctly');
        }
    }
}