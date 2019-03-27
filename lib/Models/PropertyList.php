<?php

namespace IntellirentSDK\Models;

class PropertyList extends AbstractModel
{
    /**
     * Property ID
     * 
     * @var $id
     */
    private $id;

    /**
     * Property Address
     * 
     * @var $address
     */
    private $address;

    public function __construct(int $id, string $address)
    {
        $this->id = $id;
        $this->address = $address;
    }

    /**
     * get $id
     * 
     * @return int
     */
    public function getID()
    {
        return $this->id;
    }

    /**
     * get $address
     * 
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }
}