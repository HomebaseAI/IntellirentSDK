<?php

namespace IntellirentSDK;

use IntellirentSDK\Exceptions\ValidationException;

class Configuration implements ConfigurationInterface
{
    /**
     * @var string $baseUrl 
     */
    private static $baseUrl = 'http://localhost';

    /**
     * @var string $baseResourcePath
     */
    private static $baseResourcePath = '/api/v2';

    /**
     * @var string $companyId
     */
    private static $companyId = null;

    /**
     * @var $securityToken
     */
    private static $securityToken = null;

    /**
     * Sets the Base URL
     * 
     * @throws ValidationException
     * @param string $base_url
     */
    public static function setBaseUrl(string $base_url)
    {
        if (!filter_var($base_url, FILTER_VALIDATE_URL)) {
            throw new ValidationException('Invalid base_url');     
        }

        self::$baseUrl = rtrim($base_url, '/');
    }

    /**
     * Sets the Base Resource Path
     * 
     * @param string $base_resource_path
     */
    public static function setBaseResourcePath(string $base_resource_path)
    {
        self::$baseResourcePath = $base_resource_path;
    }

    /**
     * Sets the Company ID
     * 
     * @param string $company_id
     */
    public static function setCompanyId(string $company_id)
    {
        self::$companyId = $company_id;
    }

    /**
     * Sets the Security Token
     * 
     * @param string $security_token
     */
    public static function setSecurityToken(string $security_token)
    {
        self::$securityToken = $security_token;
    }

    /**
     * Gets the Base URL
     * 
     * @return string
     */
    public function getBaseUrl()
    {
        return self::$baseUrl;
    }

    /**
     * Gets the Base Resource Path
     * 
     * @return string
     */
    public function getBaseResourcePath()
    {
        return self::$baseResourcePath;
    }

    /**
     * Gets the Company ID
     * 
     * @return string
     */
    public function getCompanyId()
    {
        return self::$companyId;
    }

    /**
     * Gets the Security Token
     * 
     * @return string
     */
    public function getSecurityToken()
    {
        return self::$securityToken;
    }
}