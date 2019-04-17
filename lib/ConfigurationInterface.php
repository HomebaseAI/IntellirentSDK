<?php

namespace IntellirentSDK;

interface ConfigurationInterface
{
    /**
     * Gets the Base URL
     * 
     * @return string
     */
    public function getBaseUrl();

    /**
     * Gets the Base Resource Path
     * 
     * @return string
     */
    public function getBaseResourcePath();

    /**
     * Gets the Company ID
     * 
     * @return string
     */
    public function getCompanyId();

    /**
     * Gets the Security Token
     * 
     * @return string
     */
    public function getSecurityToken();
}