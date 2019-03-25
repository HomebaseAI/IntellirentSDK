<?php

namespace IntellirentSDK\Models;

final class ResultMetaFactory extends AbstractModel
{
    public function __construct(array $data)
    {
        // set dynamic property for this class
        foreach ($data as $property => $value) {
            $this->{$property} = $value;
        }
    }
}