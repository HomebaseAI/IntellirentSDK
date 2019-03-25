<?php

namespace IntellirentSDK\Apis;

use IntellirentSDK\ApiClient;
use IntellirentSDK\Models\Applicant;

final class ApplicantApi extends AbstractApi
{
    /**
     * @var $resourcePath
     */
    protected $resourcePath = '/applicants/:sso_hash';

    /**
     * Create a new applicant
     * 
     * @param array|Applicant $data
     * @throws IntellirentSDK\Exceptions\SerializationException;
     * @return Object
     */
    public function create($data): object
    {
        $data = ($data instanceof Applicant) ? (array) $data : $data;

        // $user_id is not required on create
        unset($data['user_id']);

        $response = $this->call('POST', $data);

        $this->validateResponse($response[0], ['USER_ID']);

        $data['user_id'] = $response[0]->USER_ID;

        return $this->result(
            ['meta' => [
                'session_url' => $response[0]->SESSION_URL
            ], 'data' => $this->item($data, Applicant::class)]
        );
    }

    /**
     * Update existing applicant
     * 
     * @param int $userId
     * @param array $data
     * @throws IntellirentSDK\Exceptions\SerialzationException
     * @return Object
     */
    public function update(int $userId, array $data): object
    {
        // add user_id to $data as this is required
        $data['user_id'] = $userId;

        $response = $this->call('POST', $data);

        $this->validateResponse($response[0], ['SESSION_URL']);

        return $this->result(
            ['meta' => [
                'session_url' => $response[0]->SESSION_URL
            ], 'data' => $this->item($data, Applicant::class)]
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