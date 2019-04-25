<?php

namespace IntellirentSDK\Apis;

use IntellirentSDK\Models\ReferralContactResponse;

class ReferralContactApi extends AbstractApi
{
    public function createReferralContacts(array $referral)
    {
        $resourcePath = '/create_referral_contacts';

        $response = $this->apiClient->call('POST', $resourcePath, [], ['referral' => $referral]);

        $this->validateResponse($response, ['response_code', 'response']);

        return new ReferralContactResponse(
            $response->response_code,
            $response->response,
            $referral
        );
    }
}