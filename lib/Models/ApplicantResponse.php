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

    /**
     * @var $data
     */
    private $data;

    /**
     * ApplicantResponse constructor
     * 
     * @param int $id
     * @param string $sessionUrl
     * @param Applicant $applicant
     */
    public function __construct(int $id, string $sessionUrl, Applicant $applicant)
    {
        $this->id = $id;
        $this->session_url = $sessionUrl;
        $this->data = $applicant;
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

    /**
     * get $data
     * 
     * @return Applicant
     */
    public function getData()
    {
        return $this->data;
    }
}