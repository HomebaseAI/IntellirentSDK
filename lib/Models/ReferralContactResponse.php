<?php

namespace IntellirentSDK\Models;

class ReferralContactResponse extends AbstractModel
{
    /**
     * @var $response_data
     */
    private $response_code;

    /**
     * @var $response_data
     */
    private $response;

    /**
     * @var $response_data
     */
    private $data;

    /**
     * ReferralContactResponse constructor
     * 
     * @param string $code
     * @param string $response
     * @param array $data
     */
    public function __construct(string $code, string $response, array $data = null)
    {
        $this->response_code = $code;
        $this->response = $response;
        $this->data = $data;
    }

    /**
     * @return string
     */
    public function getResponseCode()
    {
        return $this->response_code;
    }

    /**
     * @return string
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }
}