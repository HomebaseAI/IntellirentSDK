<?php

namespace IntellirentSDK\Models\Collections;

use IntellirentSDK\Models\PropertyList as Property;

final class PropertyCollection extends AbstractCollection
{
    /**
     * PropertyCollection constructor
     * 
     * @param Property ...$properties
     */
    public function __construct(Property ...$properties)
    {
        $this->items = $properties;
    }
}