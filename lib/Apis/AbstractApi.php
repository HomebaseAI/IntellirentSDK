<?php

namespace IntellirentSDK\Apis;

use IntellirentSDK\ApiClient;
use IntellirentSDK\Traits\Result;
use IntellirentSDK\Traits\Validator;
use IntellirentSDK\Exceptions\ValidatorException;

abstract class AbstractApi
{
    use Validator, Result;

    /**
     * @var $securityToken
     */
    private $securityToken;

    /**
     * @var $basePath
     */
    private $basePath = '/api/v2';

    /**
     * @var $resourcePath
     */
    protected $resourcePath;

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

    /**
     * set SECURITY_TOKEN for request
     * 
     * @param string $securityToken
     * @return $this
     */
    public function setSecurityToken(string $securityToken)
    {
        $this->securityToken = $securityToken;
        return $this;
    }

    /**
     * get SECURITY_TOKEN
     * 
     * @param void
     * @return mixed
     */
    public function getSecurityToken()
    {
        return $this->securityToken;
    }

    /**
     * Set the Base Path for the API call against
     * 
     * @param mixed $basePath
     * @return $this
     */
    public function setBasePath($basePath)
    {
        $this->basePath = $basePath ?: '/api/v2';
        return $this;
    }

    /**
     * get the Base Path for the API call against
     * @param void
     * @return string
     */
    public function getBasePath(): string
    {
        return $this->basePath;
    }

    /**
     * get API resource path
     * 
     * @param void
     * @return string
     */
    public function getResourcePath(): string
    {
        return $this->resourcePath;
    }

    /**
     * get data for POST request
     * 
     * @param string $method
     * @param array $data
     * @return array
     */
    public function getPostData(string $method, array $data): array
    {
        return in_array($method, ['POST', 'PUT', 'PATCH', 'DELETE']) ? $data : [];
    }

    /**
     * get data for GET request
     * 
     * @param string $method
     * @param array $data
     * @return array
     */
    public function getQueryParams(string $method, array $data): array
    {
        return 'GET' === $method ? $data : [];
    }

    /**
     * set API resource path
     * 
     * @param string $path
     * @return $this
     */
    protected function setResourcePath($path)
    {
        $this->resourcePath = $path;
        return $this;
    }

    /**
     * Send HTTP request
     * 
     * @param string $method, HTTP verb (GET|POST|PATH|PUT|DELETE)
     * @param array|object $data, this will run through interpolation process that will construct the final resource path and the data of the HTTP request
     * @param array $headers - optional, this will override the headers of the HTTP requesst as previously set
     * @return mixed
     */
    protected function call(string $method, $data = [])
    {
        // check if we have security_token set for this request
        if (!$this->isPropertySet('securityToken')) {
            // fail fast
            throw new ValidatorException('SECURITY_TOKEN is not set or empty.');
        }

        // add SECURTY_TOKEN to request header
        $this->apiClient->addHeader('SECURITY_TOKEN', $this->securityToken);
        
        // interpolate the data, replace all wildcards found in the resource path with value found in data
        $build = $this->interpolate($data);

        // send HTTP request
        $response = $this->apiClient->call(
            $this->getBasePath() . $build->resource_path, 
            $method, 
            $this->getQueryParams($method, $build->data), 
            $this->getPostData($method, $build->data)
        );

        return $response;
    }

    /**
     * contruct resource path. checking for wildcards found in the $resourcePath and replace it with value found in $data argument
     * 
     * @param array $data
     * @return array
     */
    private function interpolate(array $data): object
    {
        // get all wildcards found in the resourcePath
        $keys = $this->getKeys();
    
        $resourcePath = array_reduce($keys, function($path, $key) use (&$data) {
            // get the key without the :
            $dataKey = substr($key, 1);

            // if data is set, replace the value of the wild card
            if (isset($data[$dataKey])) {
                // replace the wildcard
                $path = $this->replaceWildCard($path, $key, $data[$dataKey]);
                
                // remove the value from the data
                unset($data[$dataKey]);
            } else {
                // else remove the wild card
                $path = $this->replaceWildCard($path, $key, '');
            }

            return preg_replace('/\/$/', '', $path);
        }, $this->getResourcePath());

        return (object) [
            'resource_path' => $resourcePath,
            'data' => $data
        ];
    }

    /**
     * get all wildcard characters found in the resource path
     * 
     * @param void
     * @return array
     */
    private function getKeys(): array
    {
        // see if we have matches
        preg_match_all('/:[a-zA-Z_]+/i', $this->getResourcePath(), $matches);

        return $matches[0];
    }

    /**
     * replace wildcard found in haystack
     * 
     * @param string $haystack
     * @param string $needle
     * @param string $replace - optional
     * @return mixed
     */
    private function replaceWildCard(string $haystack, string $needle, string $replace = '')
    {
        $pos = strpos($haystack, $needle);

        if (false !== $pos) {
            return substr_replace($haystack, $replace, $pos, strlen($needle));
        }

        return null;
    }
}