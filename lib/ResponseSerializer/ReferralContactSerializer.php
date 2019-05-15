<?php

namespace IntellirentSDK\ResponseSerializer;

use IntellirentSDK\Models\ReferralContactResponse;

class ReferralContactSerializer extends AbstractResponseSerializer
{
    /**
     * Parse referral contact response
     * 
     * @param object $referral_contact_response
     * @param array $data
     * @return ReferralContactResponse
     */
    public function parseReferralContactResponse($referral_contact_response, $data)
    {
        $this->responseValidator->validate($referral_contact_response, ['response_code', 'response']);

        return $this->item(
            ReferralContactResponse::class,
            [
                $referral_contact_response->response_code,
                $referral_contact_response->response,
                $data
            ]
        );
    }
}