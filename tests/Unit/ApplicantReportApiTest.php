<?php

namespace IntellirentSDK\Tests;

use PHPUnit\Framework\TestCase;
use IntellirentSDK\Apis\ApplicantReportApi;
use IntellirentSDK\Models\ApplicantReport;
use IntellirentSDK\Models\ApplicantCount;

class ApplicantReportApiTest extends TestCase
{
    private $applicantReportApi;

    public function setUp()
    {
       $this->applicantReportApi = $this->createMock(ApplicantReportApi::class);
    }

    public function tearDown()
    {
        $this->applicantReportApi = null;
    }

    /** @test */
    public function can_get_applicants_count()
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

        $expected = new ApplicantCount();

        $this->applicantReportApi->expects($this->once())
             ->method('getApplicantsCount')
             ->with($this->identicalTo($applicantReport))
             ->will($this->returnValue($expected));
             

        $response = $this->applicantReportApi->getApplicantsCount($applicantReport);
        $this->assertEquals($expected, $response);
    }
}