<?php

namespace IntellirentSDK\Apis;

use IntellirentSDK\ApiClient;
use IntellirentSDK\Models\Applicant;
use IntellirentSDK\Models\ApplicantResponse;

class ApplicantApi extends AbstractApi
{
    /**
     * Create a new applicant
     * 
     * @param array|Applicant $data
     * @return Applicant
     */
    public function createApplicant($data)
    {
        $data = ($data instanceof Applicant) ? (array) $data : $data;

        $resourcePath = '/applicants';

        $response = $this->apiClient->call('POST', $resourcePath, [], $data);

        $this->validateResponse($response[0], ['USER_ID', 'SESSION_URL']);

        return new ApplicantResponse(
            $response[0]->USER_ID,
            $response[0]->SESSION_URL,
            $this->toApplicantData($data)   
        );
    }

    /**
     * Update existing applicant
     * 
     * @param int $userId
     * @param array $data
     * @return Applicant
     */
    public function updateApplicant(int $userId, array $data)
    {
        $data['user_id'] = $userId;

        $resourcePath = '/applicants';

        $response = $this->apiClient->call('POST', $resourcePath, [], $data);

        $this->validateResponse($response[0], ['USER_ID', 'SESSION_URL']);

        return new ApplicantResponse(
            $response[0]->USER_ID,
            $response[0]->SESSION_URL,
            $this->toApplicantData($data)
        );
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

    /**
     * Cast applicant data from assoc array to Applicant object
     * 
     * @param array $data
     * @return Applicant
     */
    private function toApplicantData(array $data)
    {
        return new Applicant(
            isset($data['property_id']) ? $data['property_id'] : null,
            isset($data['first_name']) ? $data['first_name'] : null,
            isset($data['last_name']) ? $data['last_name'] : null,
            isset($data['email']) ? $data['email'] : null
        );
    }
}