<?php

namespace IntellirentSDK\Apis;

use IntellirentSDK\ApiClient;
use IntellirentSDK\Models\Property;
use IntellirentSDK\Models\PropertyList;

class PropertyApi extends AbstractApi
{
    /**
     * @var $companyId
     */
    private $companyId; 

    /**
     * @var $resourcepath
     */
    protected $resourcePath = '/:company_id/properties/:property_id';

    /**
     * Set $companyId
     * 
     * @param string $companyId
     * @return $this
     */
    public function setCompanyId(string $companyId)
    {
        $this->companyId = $companyId;
        return $this;
    }

    /**
     * Get $companyId
     * 
     * @param void
     * @return mixed
     */
    public function getCompanyId()
    {
        return $this->companyId;
    }

    /**
     * List all Properties
     * 
     * @param void
     * @return array
     */
    public function list(): array
    {
        $this->assertCompanyId();

        $data = [
            'company_id' => $this->getCompanyId()
        ];

        $response = $this->call('GET', $data);
        return $this->collection($response, PropertyList::class);
    }

    /**
     * Create a new property
     * 
     * Required fields:
     * street_name_1
     * city
     * state
     * postal_code
     * agent_email
     * rate
     * security_deposit
     * bedrooms
     * bathrooms
     * 
     * @param Property $obj
     * @return Property
     */
    public function create(Property $obj): object
    {
        $this->assertCompanyId();

        // validate if data contains the required agent_email
        if (!isset($obj->agent_email)) {
            throw new \InvalidArgumentException('agent_email is not set or empty');
        }

        $data = (array) $obj;
        $data['company_id'] = $this->getCompanyId();
        
        // we don't need the property_id data on create
        unset($data['property_id']);

        $response = $this->call('POST', $data);

        // set the newly created property property_id
        $obj->property_id = $response->intellirent_property_id;

        return (object) [
            'invite_link' => $response->property_invite_link,
            'status' => $response->status,
            'data' => $obj
        ];
    }

    /**
     * Update a property
     * 
     * @param int $propertyId
     * @param array $data
     * @return Property
     */
    public function update(int $propertyId, array $data): object
    {
        $this->assertCompanyId();

        $data['property_id'] = $propertyId;
        $data['company_id'] = $this->getCompanyId();

        $response = $this->call('PUT', $data); 

        return (object) [
            'status' => $response->status,
            'data' => $this->item((object) $data, Property::class)
        ];
    }

    /**
     * Delete a property
     * 
     * @param Property $property
     */
    public function delete(Property $obj)
    {
        $this->assertCompanyId();

        if (empty($obj->property_id)) {
            throw new \InvalidArgumentException('property_id is not set or empty.');
        }

        if (empty($obj->agent_email)) {
            throw new \InvalidArgumentException('agent_email is not set or empty.');
        }

        // this request requires AGENT_EMAIL in the request header
        $this->apiClient->addHeader('AGENT_EMAIL', $obj->agent_email);

        $data = [
            'property_id' => $obj->property_id,
            'company_id' => $this->getCompanyId()
        ];

        $response = $this->call('DELETE', $data);

        // remove AGENT_EMAIL from request header
        $this->apiClient->removeHeader('AGENT_EMAIL');

        return $response->status;
    }

    /**
     * Asset company_id
     * 
     * @param void
     * @return void
     */
    private function assertCompanyId()
    {
        if (empty($this->getCompanyId())) {
            throw new \InvalidArgumentException('company_id is not set or empty.');
        }
    }
}