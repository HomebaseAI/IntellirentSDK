<?php

namespace IntellirentSDK\Tests;

use PHPUnit\Framework\TestCase;
use IntellirentSDK\Apis\ApplicantApi;
use IntellirentSDK\Models\Applicant;
use IntellirentSDK\Models\ApplicantResponse;

class ApplicantApiTest extends TestCase
{
    private $applicantApi;

    public function setUp()
    {
        $this->applicantApi = $this->createMock(ApplicantApi::class);
    }

    public function tearDown()
    {
        $this->applicantApi = null;
    }

    /** @test */
    public function can_create_applicant_from_object_argument()
    {
        $applicant = new Applicant();

        $applicant->property_id = 1234;
        $applicant->first_name = 'John';
        $applicant->last_name = 'Doe';
        $applicant->email = 'jdoe@myintellirent.com';
        $applicant->phone_number = '(123) 456-7890';

        $expected = new ApplicantResponse(
            1, 
            'https://session-url.test',
            $applicant
        );

        $this->applicantApi->expects($this->once())
             ->method('createApplicant')
             ->with($this->identicalTo($applicant))
             ->will($this->returnValue($expected));

        $response = $this->applicantApi->createApplicant($applicant);
        $this->assertEquals($expected, $response);
    }

    /** @test */
    public function can_create_applicant_from_array_argument()
    {
        $data = [
            'property_id' => 1234,
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'jdoe@myintellirent.com',
            'phone_number' => '(123) 456-7890'
        ];

        $expected = new ApplicantResponse(
            1,
            'https://session-url.test',
            new Applicant(...array_values($data))
        );

        $this->applicantApi->expects($this->once())
             ->method('createApplicant')
             ->with($data)
             ->will($this->returnValue($expected));

        $response = $this->applicantApi->createApplicant($data);
        $this->assertEquals($expected, $response);
    }

    /** @test */
    public function can_update_applicant()
    {
        $id = 1234;
        $data = [
            'first_name' => 'Jane'
        ];

        $expected = new ApplicantResponse(
            $id,
            'http://session-url.test',
            new Applicant(null, $data['first_name']) 
        );

        $this->applicantApi->expects($this->once())
             ->method('updateApplicant')
             ->with($id, $data)
             ->will($this->returnValue($expected));

        $response = $this->applicantApi->updateApplicant($id, $data);
        $this->assertEquals($expected, $response);
    }
}