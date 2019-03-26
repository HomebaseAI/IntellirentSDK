<?php

namespace IntellirentSDK\Apis;

use IntellirentSDK\ApiClient;
use IntellirentSDK\Models\Property;
use IntellirentSDK\Models\PropertyList;

final class PropertyApi extends AbstractApi
{
    /**
     * List all Properties
     * 
     * @param void
     * @return array
     */
    public function list()
    {
        $this->assertCompanyId();

        $resourcePath = $this->apiClient::getCompanyId() . '/properties';

        $response = $this->apiClient->call('GET', $resourcePath);

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
     * @param array|Property $data
     * @return Property
     */
    public function create($data)
    {
        $this->assertCompanyId();

        $data = ($data instanceof Property) ? (array) $data : $data;

        // agent email is required when creating a new property
        // throw exception if not set
        $this->assertAgentEmail($data);
        
        // we don't need the property_id data on create
        unset($data['property_id']);

        $resourcePath = $this->apiClient->getCompanyId() . '/properties';

        $response = $this->apiClient->call('POST', $resourcePath, [], $data);

        $this->validateResponse($response, ['intellirent_property_id']);

        // set the newly created property property_id
        $data['property_id'] = $response->intellirent_property_id;

        return $this->item($data, Property::class);
    }

    /**
     * Update a property
     * 
     * @param int $propertyId
     * @param array $data
     * @return Property
     */
    public function update(int $propertyId, array $data)
    {
        $this->assertCompanyId();

        $resourcePath = $this->apiClient->getCompanyId() . '/properties/' . $propertyId;

        $response = $this->apiClient->call('PUT', $resourcePath, [], $data); 

        $this->validateResponse($response, ['status']);

        $data['property_id'] = $propertyId;

        return $this->item($data, Property::class);
    }

    /**
     * Archive a property
     * 
     * @param int $propertyId
     * @param string $agentEmail
     */
    public function archive(int $propertyId, string $agentEmail)
    {
        $this->assertCompanyId();

        // this request requires AGENT_EMAIL in the request header
        $this->apiClient->addHeader('AGENT_EMAIL', $agentEmail);

        $resourcePath = $this->apiClient->getCompanyId() . '/properties/' . $propertyId;

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
        if (null === $this->apiClient->getCompanyId()) {
            throw new \InvalidArgumentException('Company id is not set or empty.');
        }
    }
}