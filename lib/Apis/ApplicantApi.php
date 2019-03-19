<?php

namespace IntellirentSDK\Apis;

use IntellirentSDK\ApiClient;
use IntellirentSDK\Models\Applicant;

class ApplicantApi extends AbstractApi
{
    public function __construct(ApiClient $apiClient)
    {
        parent::__construct($apiClient);

        // set the resource path
        $this->setResourcePath('/applicants/:sso_hash');
    }

    /**
     * Create a new applicant
     * 
     * @param Applicant $data
     * @return Applicant
     */
    public function create(Applicant $obj): Applicant
    {
        $data = (array) $obj;

        // $user_id is not required on create
        unset($data['user_id']);

        $response = $this->call('POST', $data);

        //TODO: return Applicant object with user_id set from the reponse
    }

    /**
     * Update existing applicant
     * 
     * @param int $userId
     * @param array $data
     * @return Applicant
     */
    public function update(int $userId, array $data): Applicant
    {
        // add user_id to $data as this is required
        $data['user_id'] = $userId;

        $response = $this->call('POST', $data);

        //TODO: return Applicant object with data of property being updated
    }

    /**
     * This request should contain a user_id parameter
     * 
     * @param array|Applicant
     */
    public function signIn(array $data)
    {
        return $this->call('POST', $data);
    }
}