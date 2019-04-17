<?php

namespace IntellirentSDK;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use IntellirentSDK\Exceptions\MissingCredentialException;

class ApiClient
{
    /**
     * @var array HTTP request headers of the HTTP request
     */
    private $headers = [
        'Content-Type' => 'application/json; charset=UTF-8;'
    ];

    /**
     * @var Configuration $configuration
     */
    private $configuration;

    /**
     * ApiClient constructor
     * 
     * @param Configuration $configuration
     */
    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * Add into headers of the HTTP request
     * 
     * @param string $key
     * @param mixed $value
     * @return $this
     */
    public function addHeader(string $key, $value)
    {
        $this->headers[$key] = $value;
        return $this;
    }

    /**
     * Get all headers of the HTTP request
     * 
     * @param void
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * Remove request header by key
     * 
     * @param string $key
     * @return $this
     */
    public function removeHeader(string $key)
    {
        if (isset($this->headers[$key])) {
            unset($this->headers[$key]);
        }

        return $this;
    }

    /**
     * Gets the Configuration
     * 
     * @return Configuration
     */
    public function getConfiguration()
    {
        return $this->configuration;
    }

    /**
     * Send HTTP Request
     * 
     * @param string $method, HTTP verb (GET|POST|PATCH|PUT|DELETE)
     * @param string $resourcePath, path of the resource, e.g /api/path...
     * @param array $query - optional, this will be the query params of the HTTP request
     * @param array $body - optional, this will be the post body of the HTTP request
     * @throws GuzzleException
     * @return mixed
     */
    public function call(string $method, string $resourcePath, array $query = [], array $body = [])
    {
        // init HTTP client
        $client = $this->createHttpClient();

        $url = $this->configuration->getBaseResourcePath() . '/' . trim($resourcePath, '/');
        
        // make call
        $response = $client->request(
            $method,
            $url,
            [
                'query' => $query,
                'json' => $body
            ]
        );

        return json_decode($response->getBody());
    }

    /**
     * Create a HttpClient to send HTTP request to
     * 
     * @return GuzzleHttp\Client
     */
    private function createHttpClient(): Client
    {
        if (null === $this->configuration->getSecurityToken()) {
            throw new MissingCredentialException('Security Token is not set or empty');
        }

        $this->addHeader('SECURITY_TOKEN', $this->configuration->getSecurityToken());

        return new Client([
            'base_uri' => $this->configuration->getBaseUrl(),
            'headers' => $this->getHeaders() 
        ]);
    }
}