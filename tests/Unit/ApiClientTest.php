<?php

namespace IntellirentSDK\Tests\Unit;

use PHPUnit\Framework\TestCase;
use IntellirentSDK\ApiClient;
use IntellirentSDK\Exceptions\ValidationException;

class ApiClientTest extends TestCase
{
    /** @test */
    public function has_static_base_url_attribute()
    {
        $this->assertClassHasStaticAttribute('BASE_URL', ApiClient::class);
    }

    /** @test */
    public function has_static_company_id_attribute()
    {
        $this->assertClassHasStaticAttribute('COMPANY_ID', ApiClient::class);
    }

    /** @test */
    public function has_static_security_token_attribute()
    {
        $this->assertClassHasStaticAttribute('SECURITY_TOKEN', ApiClient::class);
    }

    /** @test */
    public function valid_base_url()
    {
        $validUrl = 'http://validurl.com';

        try {
            ApiClient::setBaseUrl($validUrl);
            $this->assertTrue(true);
        } catch (ValidationException $e) {
            $this->assertTrue(false);
        }
    }

    /** @test */
    public function invalid_base_url()
    {
        $invalidUrl = 'http:/invalidurl';

        try {
            ApiClient::setBaseUrl($invalidUrl);
        } catch (ValidationException $e) {
            $this->assertEquals($e->getMessage(), 'Invalid base_url');
        }
    }
}