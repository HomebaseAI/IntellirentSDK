<?php

namespace IntellirentSDK\Apis;

use IntellirentSDK\ResponseSerializer\ReferralContactSerializer;

class ReferralContactApi extends AbstractApi
{
    /**
     * ReferralContacatApi constructor
     * 
     * @param ReferralContactSerializer $referralContactSerializer
     */
    public function __construct(ReferralContactSerializer $referralContactSerializer = null)
    {
        // Call mom!
        parent::__construct();

        $this->responseSerializer->setSerializer($this->resolve($referralContactSerializer, ReferralContactSerializer::class));
    }

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

        return $this->responseSerializer->getSerializer()->parseReferralContactResponse($response, $referral);
    }
}