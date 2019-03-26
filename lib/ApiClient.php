<?php

namespace IntellirentSDK;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use IntellirentSDK\Exceptions\ValidatorException;

class ApiClient
{
    /**
     * static @var string base url of the APIs 
     */
    private static $BASE_URL = 'http://localhost';

    /**
     * static @var string base resource path
     */
    private static $BASE_RESOURCE_PATH = '/api/v2';

    /**
     * static @var string company id of IR partner
     */
    private static $COMPANY_ID = null;

    /**
     * static @var string security token
     */
    private static $SECURITY_TOKEN = null;

    /**
     * @var array HTTP request headers of the HTTP request
     */
    private $headers = [
        'Content-Type' => 'application/json; charset=UTF-8;'
    ];

    /**
     * Set Api Base (Host) URL for calls
     * 
     * @param string $url
     */
    public static function setBaseUrl(string $baseUrl)
    {
        self::$BASE_URL = rtrim($baseUrl, '/');
    }

    /**
     * Set API base resource path
     * 
     * @param string $baseResourcePath
     */
    public static function setBaseResourcePath(string $baseResourcePath)
    {
        self::$BASE_RESOURCE_PATH = $baseResourcePath;
    }

    /**
     * Set IR partner company id
     * 
     * @param string $companyId
     */
    public static function setCompanyId(string $companyId)
    {
        self::$COMPANY_ID = $companyId;
    }

    /**
     * Get IR partner company id
     */
    public function getCompanyId()
    {
        return self::$COMPANY_ID;
    }

    /**
     * Set Security Token
     * 
     * @param string $securityToken
     */
    public static function setSecurityToken(string $securityToken)
    {
        self::$SECURITY_TOKEN = $securityToken;
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
     * @param string $method, HTTP verb (GET|POST|PATCH|PUT|DELETE)
     * @param string $resourcePath, path of the resource, e.g /api/path...
     * @param array $query - optional, this will the query params of the HTTP request
     * @param array $body - optional, this will be the post body of the HTTP request
     * @throws GuzzleException
     * @return mixed
     */
    public function call(string $method, string $resourcePath, array $query = [], array $body = [])
    {
        // init HTTP client
        $client = $this->createHttpClient();

        $url = self::$BASE_RESOURCE_PATH . '/' . $resourcePath;
        
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
        if (null === self::$SECURITY_TOKEN) {
            throw new \InvalidArgumentException('Security Token is not set or empty');
        }

        $this->addHeader('SECURITY_TOKEN', self::$SECURITY_TOKEN);

        return new Client([
            'base_uri' => self::$BASE_URL,
            'headers'  => $this->getHeaders()
        ]);
    }
}