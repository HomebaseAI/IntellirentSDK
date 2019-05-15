<?php

namespace IntellirentSDK\ResponseSerializer;

use IntellirentSDK\Models\ApplicantResponse;
use IntellirentSDK\Models\Applicant;

class ApplicantSerializer extends AbstractResponseSerializer
{
    /**
     * Parse applicant
     * 
     * @param object $applicant_response
     * @param array $data
     * @return ApplicantResponse
     */
    public function parseApplicant($applicant_response, array $data)
    {
        $this->responseValidator->validate($applicant_response, ['USER_ID', 'SESSION_URL']);

        return $this->item(
            ApplicantResponse::class,
            [
                $applicant_response->USER_ID,
                $applicant_response->SESSION_URL,
                $this->toApplicantData($data)
            ]
        );
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