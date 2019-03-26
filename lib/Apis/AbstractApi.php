<?php

namespace IntellirentSDK\Apis;

use IntellirentSDK\ApiClient;
use IntellirentSDK\Traits\Response;

abstract class AbstractApi
{
    use Response;

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