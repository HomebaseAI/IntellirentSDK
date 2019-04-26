<?php

namespace IntellirentSDK\Apis;

use IntellirentSDK\Models\ReferralContactResponse;

class ReferralContactApi extends AbstractApi
{
    /**
     * Create te referrer's information of each of the recipient on the hubspot, provided in te request
     * 
     * @param array $referral
     * @return ReferralContactResponse
     */
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