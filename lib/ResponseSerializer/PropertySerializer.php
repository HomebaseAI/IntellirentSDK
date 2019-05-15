<?php

namespace IntellirentSDK\ResponseSerializer;

use IntellirentSDK\Models\Property as PropertyData;
use IntellirentSDK\Models\NewPropertyResponse as NewProperty;
use IntellirentSDK\Models\PropertyList as Property;
use IntellirentSDK\Models\Collections\PropertyCollection;
use ReflectionClass;


class PropertySerializer extends AbstractResponseSerializer
{
    /**
     * Parse new property response
     * 
     * @param object $property_response
     * @param array $data
     * @return NewProperty
     */
    public function parseNewPropertyResponse($property_response, $data)
    {
        $this->responseValidator->validate($property_response, ['intellirent_property_id', 'property_invite_link', 'status']);

        return $this->item(
            NewProperty::class,
            [
                $property_response->intellirent_property_id, 
                $property_response->property_invite_link, 
                $property_response->status,
                $this->toPropertyObject($data)
            ]
        );
    }

    /**
     * Parse property
     * 
     * @param object $property_response
     * @return Property
     */
    public function parseProperty($property_response)
    {
        $this->responseValidator->validate($property_response, ['id', 'address']);

        return $this->item(
            Property::class,
            [
                $property_response->id,
                $property_response->address
            ]
        );
    }

    /**
     * Parses property list
     * 
     * @param object $properties_response
     * @return PropertyCollection
     */
    public function parseProperties($properties_response)
    {
        $properties = [];

        foreach ($properties_response as $property) {
            $properties[] = $this->parseProperty($property);
        }

        return $this->collection(PropertyCollection::class, $properties);
    }

      /**
     * Cast array of data to Property object
     * 
     * @param array $data
     * @return PropertyData
     */
    private function toPropertyObject(array $data)
    {
        $rc = new ReflectionClass(PropertyData::class);
        $constructorParams = $rc->getConstructor()->getParameters();

        $arguments = [];

        foreach ($constructorParams as $param) {
            $argument = $this->fromCamelCase($param->name);
            $arguments[] = $data[$argument];
        }

        return $rc->newInstanceArgs($arguments);
    }
}