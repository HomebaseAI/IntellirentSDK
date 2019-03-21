<?php

namespace IntellirentSDK\Models;

class Agent extends AbstractModel
{
    /**
     * @var $id
     */
    public $id;

    /**
     * @var $email
     */
    public $email;

    public function __construct(int $id, string $email)
    {
        $this->id = $id;
        $this->email = $email;
    }
}