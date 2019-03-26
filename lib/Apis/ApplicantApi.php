<?php

namespace IntellirentSDK\Apis;

use IntellirentSDK\ApiClient;
use IntellirentSDK\Models\Applicant;
use IntellirentSDK\Models\ApplicantResponse;

final class ApplicantApi extends AbstractApi
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

        // $user_id is not required on create
        unset($data['user_id']);

        $resourcePath = '/applicants';

        $response = $this->apiClient->call('POST', $resourcePath, [], $data);

        $this->validateResponse($response[0], ['USER_ID', 'SESSION_URL']);

        return new ApplicantResponse(
            $response[0]->USER_ID,
            $response[0]->SESSION_URL   
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
            $response[0]->SESSION_URL
        );
    }

    /**
     * This request should contain a user_id parameter
     * 
     * @param int $userId
     * @param array $data
     */
    public function signIn(int $userId, array $data)
    {
        return $this->call('POST', $data);
    }
}