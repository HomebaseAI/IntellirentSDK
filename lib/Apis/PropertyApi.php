<?php

namespace IntellirentSDK\Apis;

use IntellirentSDK\ApiClient;
use IntellirentSDK\Models\Property;
use IntellirentSDK\Models\PropertyList;

final class PropertyApi extends AbstractApi
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
     * @return object
     */
    public function list(): object
    {
        $this->assertCompanyId();

        $data = [
            'company_id' => $this->getCompanyId()
        ];

        $response = $this->call('GET', $data);

        return $this->result(
            ['data' => $this->collection($response, PropertyList::class)]
        );
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
     * @throws IntellirentSDK\Exceptions\SerializationException
     * @return object
     */
    public function create($data): object
    {
        $this->assertCompanyId();

        $data = ($data instanceof Property) ? (array) $data : $data;
        $data['company_id'] = $this->getCompanyId();

        $this->assertAgentEmail($data);
        
        // we don't need the property_id data on create
        unset($data['property_id']);

        $response = $this->call('POST', $data);

        $this->validateResponse($response, ['intellirent_property_id']);

        // set the newly created property property_id
        $data['property_id'] = $response->intellirent_property_id;

        return $this->result(
            ['meta' => [
                'invite_link' => $response->property_invite_link, 
                'status' => $response->status
            ], 'data' => $this->item($data, Property::class)]
        );
    }

    /**
     * Update a property
     * 
     * @param int $propertyId
     * @param array $data
     * @throws IntellirentSDK\Exceptions\SerializationException;
     * @return object
     */
    public function update(int $propertyId, array $data): object
    {
        $this->assertCompanyId();

        $data['property_id'] = $propertyId;
        $data['company_id'] = $this->getCompanyId();

        $response = $this->call('PUT', $data); 

        $this->validateResponse($response, ['status']);

        return $this->result(
            ['meta' => [
                'status' => $response->status 
            ], 'data' => $this->item($data, Property::class)]
        );
    }

    /**
     * Delete a property
     * 
     * @param int $propertyId
     * @param string $agentEmail
     */
    public function delete(int $propertyId, string $agentEmail)
    {
        $this->assertCompanyId();

        // this request requires AGENT_EMAIL in the request header
        $this->apiClient->addHeader('AGENT_EMAIL', $agentEmail);

        $data = [
            'property_id' => $propertyId,
            'company_id' => $this->getCompanyId()
        ];

        $response = $this->call('DELETE', $data);

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
            throw new \InvalidArgumentException('agent_email is not set or empty.');
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
        if (empty($this->getCompanyId())) {
            throw new \InvalidArgumentException('company_id is not set or empty.');
        }
    }
}