<?php

namespace IntellirentSDK\Apis;

use IntellirentSDK\ApiClient;
use IntellirentSDK\ResponseSerializer;
use IntellirentSDK\Traits\ObjectResolver;

abstract class AbstractApi
{
    use ObjectResolver;

    /**
     * @var $apiClient
     */
    protected $apiClient;

    /**
     * @var $responseSerializer
     */
    protected $responseSerializer;

    /**
     * Default Api constructor
     * 
     * @param ApiClient $apiClient
     * @param ResponseSerializer $responseSerializer
     */
    public function __construct(ApiClient $apiClient = null, ResponseSerializer $responseSerializer = null)
    {
        $this->apiClient = $this->resolve($apiClient, ApiClient::class);
        $this->responseSerializer = $this->resolve($responseSerializer, ResponseSerializer::class);
    }
}