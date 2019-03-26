<?php

namespace IntellirentSDK\Apis;

use IntellirentSDK\ApiClient;
use IntellirentSDK\Traits\Result;
use IntellirentSDK\Traits\Validator;
use IntellirentSDK\Traits\Response;
use IntellirentSDK\Exceptions\ValidatorException;

abstract class AbstractApi
{
    use Validator, Result, Response;

    /**
     * @var $apiClient
     */
    protected $apiClient;

    public function __construct(ApiClient $apiClient)
    {
        $this->setApiClient($apiClient);
    }

    /**
     * set the API client
     * 
     * @param ApiClient $apiClient
     * @return $this
     */
    public function setApiClient(ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
        return $this;
    }

    /**
     * get the API client
     * 
     * @param void
     * @return ApiClient
     */
    public function getApiClient(): ApiClient
    {
        return $this->apiClient;
    }
}