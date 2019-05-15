<?php

namespace IntellirentSDK\Apis;

use IntellirentSDK\Models\Applicant;
use IntellirentSDK\ResponseSerializer\ApplicantSerializer;

class ApplicantApi extends AbstractApi
{
    /**
     * ApplicantApi constructor
     * 
     * @param ApplicantSerializer $applicantSerializer
     */
    public function __construct(ApplicantSerializer $applicantSerializer = null)
    {
        // Call mom!
        parent::__construct();

        $this->responseSerializer->setSerializer($this->resolve($applicantSerializer, ApplicantSerializer::class));
    }

    /**
     * Create a new applicant
     * 
     * @param array|Applicant $data
     * @return ApplicantResponse
     */
    public function createApplicant($data)
    {
        $data = ($data instanceof Applicant) ? (array) $data : $data;

        $resourcePath = '/applicants';

        $response = $this->apiClient->call('POST', $resourcePath, [], $data);

        return $this->responseSerializer->getSerializer()->parseApplicant($response[0], $data);
    }

    /**
     * Update existing applicant
     * 
     * @param int $userId
     * @param array $data
     * @return ApplicantResponse
     */
    public function updateApplicant(int $userId, array $data)
    {
        $data['user_id'] = $userId;

        $resourcePath = '/applicants';

        $response = $this->apiClient->call('POST', $resourcePath, [], $data);

        return $this->responseSerializer->getSerializer()->parseApplicant($response[0], $data);
    }

    /**
     * TODO: This request should contain a user_id parameter
     * 
     * @param int $userId
     * @param array $data
     */
    public function signIn(int $userId, array $data)
    {
        $resourcePath = '/applicants';
        // return $this->call('POST', $data);
    }
}