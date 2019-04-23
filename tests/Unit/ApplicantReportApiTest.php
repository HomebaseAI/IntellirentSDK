<?php

namespace IntellirentSDK\Tests;

use PHPUnit\Framework\TestCase;
use IntellirentSDK\ApiClient;
use IntellirentSDK\Apis\ApplicantReportApi;
use IntellirentSDK\Models\ApplicantReport;
use IntellirentSDK\Models\ApplicantCount;

class ApplicantReportApiTest extends TestCase
{
    private $applicantReportApi;

    public function setUp()
    {
        $baseUrl = 'https://private-anon-396a0e7408-intellirent.apiary-mock.com';
        $baseResourcePath = '/api/v2';
        $securityToken = 'xxxxxxxxxxxxxxxxxxxxxx';

        ApiClient::setBaseUrl($baseUrl);
        ApiClient::setBaseResourcePath($baseResourcePath);
        ApiClient::setSecurityToken($securityToken);

        $apiClient = new ApiClient();

        $this->applicantReportApi = new ApplicantReportApi($apiClient);
    }

    public function tearDown()
    {
        $this->applicantReportApi = null;
    }

    /** @test */
    public function get_applicants_count()
    {
        $applicantReport = new ApplicantReport(
            '2018-01-01', 
            '2018-12-31',
            [
                "superagent@intellirent.com",
                "email.usmanasif@gmail.com",
                "admin@myintellirent.com"
            ] 
        );

        $response = $this->applicantReportApi->getApplicantsCount($applicantReport);
        $this->assertInstanceOf(ApplicantCount::class, $response);
    }
}