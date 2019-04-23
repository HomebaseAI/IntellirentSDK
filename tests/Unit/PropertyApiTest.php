<?php

namespace IntellirentSDK\Tests;

use PHPUnit\Framework\TestCase;
use IntellirentSDK\ApiClient;
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
        $baseUrl = 'https://private-anon-396a0e7408-intellirent.apiary-mock.com';
        $baseResourcePath = '/api/v2';
        $securityToken = 'xxxxxxxxxxxxxxxxxxxxxx';
        $companyId = 'test';

        ApiClient::setBaseUrl($baseUrl);
        ApiClient::setBaseResourcePath($baseResourcePath);
        ApiClient::setSecurityToken($securityToken);
        ApiClient::setCompanyId($companyId);

        $apiClient = new ApiClient();

        $this->propertyApi = new PropertyApi($apiClient);
    }

    public function tearDown()
    {
        $this->propertyApi = null;
    }

    /** @test */
    public function list_all_properties()
    {
        $response = $this->propertyApi->listAllProperties();
        $this->assertInstanceOf(PropertyList::class, $response[0]);
    }

    /** @test */
    public function create_property_from_obj()
    {
        $property = new IntellirentSDK\Models\Property();

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

        $response = $this->propertyApi->createProperty($property);
        $this->assertInstanceOf(NewPropertyResponse::class, $response);
    }

    /** @test */
    public function create_property_from_arr()
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

        $response = $this->propertyApi->createProperty($property);
        $this->assertInstanceOf(NewPropertyResponse::class, $response);
    }

    /** @test */
    public function update_property()
    {
        $properties = $this->propertyApi->listAllProperties();

        $data = [
            'unit_number' => 2,
            'parking' => 2
        ];

        $response = $this->propertyApi->updateProperty($properties[0], $data);
        $this->assertRegExp('/updated/i', $response);
    }

    /** @test */
    public function archive_property()
    {
        $properties = $this->propertyApi->listAllProperties();
        $agentEmail = 'jdoe@myintellirent.com';

        $response = $this->propertyApi->archiveProperty($properties, $agentEmail);
        $this->assertRegExp('/Archived Successfully/i', $response);
    }
}