<?php

namespace IntellirentSDK\Models;

use JsonSerializable;

abstract class AbstractModel implements JsonSerializable, ModelInterface
{
    /**
     * Specify data which should be serialized to JSON
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be srialize by <b>json_encode</b>, which is a vaue of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}