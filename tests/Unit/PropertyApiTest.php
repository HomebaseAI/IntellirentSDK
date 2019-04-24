<?php

namespace IntellirentSDK\Tests;

use PHPUnit\Framework\TestCase;
use IntellirentSDK\Apis\PropertyApi;
use IntellirentSDK\Exceptions\MissingCredentialException;
use IntellirentSDK\Models\Property;
use IntellirentSDK\Models\PropertyList;
use IntellirentSDK\Models\NewPropertyResponse;

class PropertyApiTest extends TestCase
{
    private $propertyApi;

    public function setUp()
    {
        $this->propertyApi = $this->createMock(PropertyApi::class);
    }

    public function tearDown()
    {
        $this->propertyApi = null;
    }

    /** @test */
    public function can_list_all_properties()
    {
        $expected = new PropertyList(
            1,
            'Test Address'
        );

        $this->propertyApi->expects($this->once())
             ->method('listAllProperties')
             ->will($this->returnValue($expected));

        $response = $this->propertyApi->listAllProperties();
        $this->assertEquals($expected, $response);
    }

    /** @test */
    public function can_create_property_from_object_argument()
    {
        $property = new Property();

        $property->street_name_1 = '5th avenue';
        $property->city = 'Santa Clara';
        $property->state = 'NY';
        $property->postal_code = '23456';
        $property->rate = 1500;
        $property->security_deposit = 1500;
        $property->bedrooms = 2;
        $property->bathrooms = 2;
        $property->agent_email = 'jdoe@myintellirent.com';
        $property->street_name_2 = 'governet house';
        $property->unit_number = 1;
        $property->parking = 1;
        $property->property_type = 'HOUSE';
        $property->available_date = '2/2/2017';
        $property->lease_terms = '6 months';
        $property->amenities = ["Hardwood floors","Elevator in building","Garden","On-site gym"];
        $property->pictures = ["https://up-production.s3.amazonaws.com/uploads/grid_view_c8313a34-1402-4350-82cc-d0d103927c0e.jpg"];

        $expected = new NewPropertyResponse(
            1,
            'https://invite-link.test',
            'published'
        );

        $this->propertyApi->expects($this->once())
             ->method('createProperty')
             ->with($this->identicalTo($property))
             ->will($this->returnValue($expected));

        $response = $this->propertyApi->createProperty($property);
        $this->assertEquals($expected, $response);
    }

    /** @test */
    public function can_create_property_from_array_argument()
    {
        $property = [
            'agent_email' => 'jdoe@myintellirent.com',
            'street_name_1' => '5th avenue',
            'street_name_2' => 'governer house',
            'unit_number' => 1,
            'city' => 'Santa Clara',
            'state' => 'NY',
            'utilities' => 'All utilities included',
            'postal_code' => '23456',
            'rate' => 1500,
            'security_deposit' => 1500,
            'bedrooms' => 2,
            'bathrooms' => 2,
            'parking' => 1,
            'property_type' => 'HOUSE',
            'available_date' => '2/2/2017',
            'lease_duration' => '6 months lease',
            'description' => 'very beautiful',
            'amenities' => ['Hardwood floors','Elevator in building','Garden','On-site gym'],
            'pictures' => ['https://up-production.s3.amazonaws.com/uploads/grid_view_c8313a34-1402-4350-82cc-d0d103927c0e.jpg']
        ];

        $expected = new NewPropertyResponse(
            1,
            'http://invite-link',
            'published'
        );

        $this->propertyApi->expects($this->once())
             ->method('createProperty')
             ->with($property)
             ->will($this->returnValue($expected));

        $response = $this->propertyApi->createProperty($property);
        $this->assertEquals($response, $response);
    }

    /** @test */
    public function can_update_property()
    {
        $property = new PropertyList(1, 'Test Address');

        $data = [
            'unit_number' => 2,
            'parking' => 2
        ];

        $this->propertyApi->expects($this->once())
             ->method('updateProperty')
             ->with($this->identicalTo($property), $data)
             ->will($this->returnValue('updated'));

        $response = $this->propertyApi->updateProperty($property, $data);
        $this->assertRegExp('/updated/i', $response);
    }

    /** @test */
    public function can_archive_property()
    {
        $property = new PropertyList(1, 'Test Address');
        $agentEmail = 'jdoe@myintellirent.com';

        $this->propertyApi->expects($this->once())
             ->method('archiveProperty')
             ->with($this->identicalTo($property), $agentEmail)
             ->will($this->returnValue('Archived Successfully'));

        $response = $this->propertyApi->archiveProperty($property, $agentEmail);
        $this->assertRegExp('/Archived Successfully/i', $response);
    }
}