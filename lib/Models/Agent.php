<?php

namespace IntellirentSDK\Models;

class Agent extends AbstractModel
{
    /**
     * @var $id
     */
    private $id;

    /**
     * @var $email
     */
    private $email;

    public function __construct(int $id, string $email)
    {
        $this->id = $id;
        $this->email = $email;
    }

    /**
     * get $id
     * 
     * return int
     */
    public function getID()
    {
        return $this->id;
    }

    /**
     * get $email
     * 
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }
}