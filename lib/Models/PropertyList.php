<?php

namespace IntellirentSDK\Models;

class PropertyList extends AbstractModel
{
    /**
     * Property ID
     * 
     * @var $id
     */
    public $id;

    /**
     * Property Address
     * 
     * @var $address
     */
    public $address;

    public function __construct(int $id, string $address)
    {
        $this->id      = $id;
        $this->address = $address;
    }
}