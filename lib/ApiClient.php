<?php

namespace IntellirentSDK;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use IntellirentSDK\Traits\Validator;
use IntellirentSDK\Traits\Helper;
use IntellirentSDK\Exceptions\ValidatorException;

class ApiClient
{
    use Validator, Helper;

    /**
     * @var string base url of the APIs 
     */
    private $baseUrl = 'http://localhost';

    /**
     * @var array HTTP request headers of the HTTP request
     */
    private $headers = [
        'Content-Type' => 'application/json; charset=UTF-8;'
    ];

    /**
     * ApiClient constructor
     * 
     * @param string $baseUrl - optional
     */
    public function __construct(string $baseUrl = null) {
        $this->setBaseUrl($baseUrl ?: $this->getBaseUrl());

        // see if we have a valid url set for the HTTP client
        // failfast
        if (!$this->isValidUrl($this->getBaseUrl())) {
            throw new ValidatorException('The host url provided is\'t a valid url. ' . $this->getBaseUrl());
        }
    }

    /**
     * Set Api Base (Host) URL for HTTP client
     * 
     * @param string $url
     * @return $this
     */
    public function setBaseUrl(string $baseUrl)
    {
        $this->baseUrl = rtrim($baseUrl, '/');
        return $this;
    }

    /**
     * Get Base URL
     * 
     * @param void
     * @return string
     */
    public function getBaseUrl(): string
    {
        return $this->baseUrl;
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
     * Set headers for the HTTP request
     * 
     * @param array $headers
     * @return $this
     */
    public function setHeaders(array $headers)
    {
        $this->headers = $headers;
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
     * Send HTTP Request
     * 
     * @param string $resourcePath, path of the resource, e.g /api/path...
     * @param string $method, HTTP verb (GET|POST|PATCH|PUT|DELETE)
     * @param array $query - optional, this will the query params of the HTTP request
     * @param array $body - optional, this will be the post body of the HTTP request
     * @throws GuzzleException
     * @return mixed
     */
    public function call(string $resourcePath, string $method, array $query = [], array $body = [])
    {
        // init HTTP client
        $client = $this->createHttpClient();
        
        // make call
        $response = $client->request(
            $method,
            $this->getBaseUrl() . $resourcePath,
            [
                'query' => $query,
                'json' => $body
            ]
        );

        $responseBody = $response->getBody();

        // check for a valid json
        // temporary fix for malformed json string particularlly with smart quotes character instead of requlat quotes charcter (standard)
        // will amend this code as soon as the IR API correct their response format
        if (!$this->isValidJSON($responseBody)) {
            $responseBody = iconv('UTF-8', 'ASCII//TRANSLIT', $responseBody);
        }

        return json_decode($responseBody);
    }

    /**
     * Create a HttpClient to send HTTP request to
     * 
     * @return GuzzleHttp\Client
     */
    private function createHttpClient(): Client
    {
        return new Client([
            'base_uri' => $this->getBaseUrl(),
            'headers'  => $this->getHeaders()
        ]);
    }
}