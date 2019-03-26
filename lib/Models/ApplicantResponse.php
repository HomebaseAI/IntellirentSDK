<?php

namespace IntellirentSDK\Models;

class ApplicantResponse extends AbstractModel
{
    /**
     * @var $id
     */
    private $id;
    
    /**
     * @var $session_url
     */
    private $session_url;

    public function __construct(int $id, string $sessionUrl)
    {
        $this->id = $id;
        $this->session_url = $sessionUrl;
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
     * get $session_url
     * 
     * @return int
     */
    public function getSessionUrl()
    {
        return $this->session_url;
    }
}