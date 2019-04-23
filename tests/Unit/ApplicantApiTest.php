<?php

namespace IntellirentSDK\Tests;

use PHPUnit\Framework\TestCase;
use IntellirentSDK\ApiClient;
use IntellirentSDK\Apis\ApplicantApi;
use IntellirentSDK\Models\Applicant;
use IntellirentSDK\Models\ApplicantResponse;

class ApplicantApiTest extends TestCase
{
    private $applicantApi;

    public function setUp()
    {
        $baseUrl = 'https://private-anon-396a0e7408-intellirent.apiary-mock.com';
        $baseResourcePath = '/api/v2';
        $securityToken = 'xxxxxxxxxxxxxxxxxxxxxx';

        ApiClient::setBaseUrl($baseUrl);
        ApiClient::setBaseResourcePath($baseResourcePath);
        ApiClient::setSecurityToken($securityToken);

        $apiClient = new ApiClient();

        $this->applicantApi = new ApplicantApi($apiClient);
    }

    public function tearDown()
    {
        $this->applicantApi = null;
    }

    /** @test */
    public function create_applicant_from_obj()
    {
        $applicant = new Applicant();

        $applicant->property_id = 1234;
        $applicant->first_name = 'John';
        $applicant->last_name = 'Doe';
        $applicant->email = 'jdoe@myintellirent.com';
        $applicant->phone_number = '(123) 456-7890';

        $response = $this->applicantApi->createApplicant($applicant);
        $this->assertInstanceOf(ApplicantResponse::class, $response);
    }

    /** @test */
    public function create_applicant_from_arr()
    {
        $data = [
            'property_id' => 1234,
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'jdoe@myintellirent.com',
            'phone_number' => '(123) 456-7890'
        ];

        $response = $this->applicantApi->createApplicant($data);
        $this->assertInstanceOf(ApplicantResponse::class, $response);
    }

    /** @test */
    public function update_applicant()
    {
        $id = 1234;
        $data = [
            'first_name' => 'Jane'
        ];

        $response = $this->applicantApi->update($id, $data);
        $this->assertInstanceOf(ApplicantResponse::class, $response);
    }
}