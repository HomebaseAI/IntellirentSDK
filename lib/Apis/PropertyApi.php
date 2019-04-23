<?php

namespace IntellirentSDK\Apis;

use IntellirentSDK\ApiClient;
use IntellirentSDK\Models\Property;
use IntellirentSDK\Models\PropertyList;
use IntellirentSDK\Models\NewPropertyResponse;
use IntellirentSDK\Exception\MissingCredentialException;

final class PropertyApi extends AbstractApi
{
    /**
     * List all Properties
     * 
     * @param void
     * @return array
     */
    public function listAllProperties()
    {
        $this->assertCompanyId();

        $resourcePath = $this->apiClient->getConfiguration()->getCompanyId() . '/properties';

        $response = $this->apiClient->call('GET', $resourcePath);

        $properties = [];

        foreach ($response as $property) {
            $properties[] = new PropertyList($property->id, $property->address);
        }

        return $properties;
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
     * @param array|Property $data
     * @return Property
     */
    public function createProperty($data)
    {
        $this->assertCompanyId();

        $data = ($data instanceof Property) ? (array) $data : $data;

        // agent email is required when creating a new property
        // throw exception if not set
        $this->assertAgentEmail($data);
        
        // we don't need the property_id data on create
        unset($data['property_id']);

        $resourcePath = $this->apiClient->getConfiguration()->getCompanyId() . '/properties';

        $response = $this->apiClient->call('POST', $resourcePath, [], $data);

        $this->validateResponse($response, ['intellirent_property_id', 'property_invite_link', 'status']);
     
        return new NewPropertyResponse(
            $response->intellirent_property_id, 
            $response->property_invite_link, 
            $response->status
        );
    }

    /**
     * Update a property
     * 
     * @param PropertyList $property
     * @param array $data
     * @return Property
     */
    public function updateProperty(PropertyList $property, array $data)
    {
        $this->assertCompanyId();
        $this->assertProperty($property);

        $resourcePath = $this->apiClient->getConfiguration()->getCompanyId() . '/properties/' . $property->getID();

        $response = $this->apiClient->call('PUT', $resourcePath, [], $data); 

        $this->validateResponse($response, ['status']);

        return $response->status;
    }

    /**
     * Archive a property
     * 
     * @param PropertList $property
     * @param string $agentEmail
     */
    public function archiveProperty(PropertyList $property, string $agentEmail)
    {
        $this->assertCompanyId();
        $this->assertProperty($property);

        // this request requires AGENT_EMAIL in the request header
        $this->apiClient->addHeader('AGENT_EMAIL', $agentEmail);

        $resourcePath = $this->apiClient->getConfiguration()->getCompanyId() . '/properties/' . $property->getID();

        $response = $this->apiClient->call('DELETE', $resourcePath);

        // remove AGENT_EMAIL from request header
        $this->apiClient->removeHeader('AGENT_EMAIL');

        return $response->status;
    }

    /**
     * Assert agent_email
     * 
     * @param array $data
     * @return void
     */
    private function assertAgentEmail(array $data)
    {
        if (!isset($data['agent_email']) || empty($data['agent_email'])) {
            throw new \InvalidArgumentException('Agent email is not set or empty.');
        }
    }

    /**
     * Assert company_id
     * 
     * @param void
     * @return void
     */
    private function assertCompanyId()
    {
        if (null === $this->apiClient->getConfiguration()->getCompanyId()) {
            throw new MissingCredentialException('Company id is not set or empty.');
        }
    }

    /**
     * Assert property object
     * 
     * @param PropertyList $property
     * @return void
     */
    private function assertProperty(PropertyList $property)
    {
        if (null === $property) {
            throw new \InvalidArgumentException('Property not provided');
        }
    }
}