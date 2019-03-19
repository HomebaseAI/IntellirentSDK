<?php

namespace IntellirentSDK\Apis;

use IntellirentSDK\ApiClient;
use IntellirentSDK\Models\Property;
use IntellirentSDK\Models\PropertyList;

class PropertyApi extends AbstractApi
{
    private $companyId; 

    public function __construct(ApiClient $apiClient, string $companyId)
    {
        parent::__construct($apiClient);

        $this->setCompanyId($companyId);

        // set resource path
        $this->setResourcePath('/' . $this->getCompanyId() . '/properties/:property_id');
    }

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
     * @return string
     */
    public function getCompanyId(): string
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
        $response = $this->call('GET');
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
    public function create(Property $obj): Property
    {
        // validate if data contains the required agent_email
        if (!isset($obj->agent_email)) {
            throw new \InvalidArgumentException('agent_email is not set or empty');
        }

        $data = (array) $obj;
        
        // we don't need the property_id data
        unset($data['property_id']);

        $response = $this->call('POST', $data);
        
        $obj->property_id = $response->intellirent_property_id;
        
        return $obj;
    }

    /**
     * Update a property
     * 
     * @param int $propertyId
     * @param array $data
     * @return Property
     */
    public function update(int $propertyId, array $data): Property
    {
        // add property_id to data
        $data['property_id'] = $propertyId;

        $response = $this->call('PUT', $data); 

        return $this->item((object) $data, Property::class);
    }

    /**
     * Delete a property
     * 
     * @param Property $property
     */
    public function delete(Property $obj)
    {
        if (empty($obj->property_id)) {
            throw new \InvalidArgumentException('property_id is not set or empty.');
        }

        if (empty($obj->agent_email)) {
            throw new \InvalidArgumentException('agent_email is not set or empty.');
        }

        // this request requires AGENT_EMAIL in the request header
        $this->apiClient->addHeader('AGENT_EMAIL', $obj->agent_email);

        $response = $this->call('DELETE', ['property_id' => $obj->property_id]);

        // remove AGENT_EMAIL from request header
        $this->apiClient->removeHeader('AGENT_EMAIL');

        return $response->status;
    }
}